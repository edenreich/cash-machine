<!DOCTYPE html>
<html>
<head>
  <title>Cash-Machine</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="error"></div>
      <div class="col-md-12">
        <h1>Cash-Machine</h1>
      </div>
    <form id="cashMachineForm" action="api/v1/withdraw" method="GET">
      <div class="form-group">
        <div class="col-md-4">
          <input type="number" class="form-control" name="notes" step="1" />
          <div class="help-block"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-4">
          <input type="submit" class="btn btn-primary" value="Withdraw">
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
    var CashMachine = function() {
        
        function withdraw(notes) {
          if (isNaN(notes)) {
            throw new Error('Notes must be a number!');
          }

          var form = $("#cashMachineForm");
          var action = form.attr('action');
          var verb = form.attr('method');

          return $.ajax({
            url: action,
            method: verb,
            dataType: 'json',
            data: { "notes": notes },
            beforeSend: function() {
              var formGroup = form.find('input[name="notes"]').closest('.form-group'); 
              formGroup.removeClass('has-error');
              formGroup.find('.help-block').html('');
            }
          });
        }

        return {
          withdraw: withdraw
        };
    };

    (function(window, $, CashMachine, undefined) {
      var cashMachine = new CashMachine;
      var form = $('#cashMachineForm');

      form.on('submit', function(e) {
        e.preventDefault();
        var formGroup = $(this).find('input[name="notes"]').closest('.form-group');
        var notes = $(this).find('input[name="notes"]').val();
        var request = cashMachine.withdraw(notes);

        request.then(function(response) {
          formGroup.addClass('has-success');

          if (response.notes.length === 0) {
            formGroup.find('.help-block').html('You did not withdraw any notes!');            
          } else {
            formGroup.find('.help-block').html('You withdrawed '+response.notes.join(', ')+' notes successfully!');
          }
        }).catch(function() {
          formGroup.addClass('has-error');
          formGroup.find('.help-block').html('Something went wrong! Notes are not available or the input was invalid!');
        });
      });

    })(window, jQuery, CashMachine);
  </script>
</body>
</html>