(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

    var i = 1;
    $(document).one('click','#addmore', function(){
        $('#dynamic_field').append('<tr id="row'+i+'"><td>' +
            '<input type="text" class="form-control" name="numberinput[]" placeholder="Alternative Phone Number" required></td>' +
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click','.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row"+button_id+'').remove();
        $(document).one('click','#addmore', function(){
            $('#dynamic_field').append('<tr id="row'+i+'"><td>' +
                '<input type="text" class="form-control" name="numberinput[]" placeholder="Alternative Phone Number" required></td>' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
    });

})(document);
