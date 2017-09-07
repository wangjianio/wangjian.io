<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';

// 检查 Session
$common = new Common;
$common->checkSession();

$a_type_id = $_GET['a_type_id'];

if ($a_type_id == '1' || $a_type_id == '2' || $a_type_id == '3') {

switch ($a_type_id) {
  case '1':
    $form_head = '<label class="col-xs-6 control-label" style="text-align: center">账户名称</label>
                  <label class="col-xs-6 control-label" style="text-align: center">余额</label>';
    break;
    
  case '2':
    $form_head = '<label class="col-xs-4 control-label" style="text-align: center">账户名称</label>
                  <label class="col-xs-4 control-label" style="text-align: center">欠款</label>
                  <label class="col-xs-4 control-label" style="text-align: center">额度</label>';
    break;

  case '3':
    $form_head = '<label class="col-xs-6 control-label" style="text-align: center">账户名称</label>
                  <label class="col-xs-6 control-label" style="text-align: center">价值</label>';
    break;
  
  default:
    break;
}

?>
<form class="form-horizontal" id="form-account-edit" method="post" action="server?action=edit&a_type_id=<?php echo $a_type_id; ?>">
  <div class="form-group" id="form-head">
    <?php echo $form_head; ?>
  </div>
</form>

<button class="btn btn-success btn-block" id="btn-add" type="button">新增</button>

<script>
  $(function () {
    if (<?php echo $a_type_id; ?> == 3) {
      $('#form-head').after('<hr>');
    }

    for (var key in json) {
      if (json.hasOwnProperty(key)) {
        var a_id = json[key].a_id;
        var a_name = json[key].a_name;
        var a_type_id = json[key].a_type_id;
        var money_1 = json[key].money_1;
        var money_2 = json[key].money_2;

        if (a_type_id == <?php echo $a_type_id; ?>) {
          appendFormControl(a_id, a_name, a_type_id, money_1, money_2);
        }
      }
    }

    $('.btn-remove-old').on('click', function (e) {
      if (confirm('确认删除？')) {
        $(e.target).parent().hide();
        $(e.target).parent().children('[name$="[valid]"]').val('0');
      }
    });

    $(document).on('click', '.btn-remove-new', function (e) {
      $(e.target).parent().remove();
    });

    $('#btn-add').on('click', function () {
      appendNewFormControl(<?php echo $a_type_id; ?>);
    })
  });

  function appendFormControl(a_id, a_name, a_type_id, money_1, money_2 = null) {
    switch (a_type_id) {
      case 1:
        $('#form-account-edit').append('\
          <div class="form-group">\
            <input name="'+a_id+'[a_id]" type="hidden" value="'+a_id+'">\
            <input name="'+a_id+'[valid]" type="hidden" value="1">\
            <div class="col-xs-6">\
              <input class="form-control" name="'+a_id+'[a_name]" type="text" value="'+a_name+'" placeholder="输入名称">\
            </div>\
            <div class="col-xs-6">\
              <input class="form-control" name="'+a_id+'[money_1]" type="number" value="'+money_1+'" placeholder="输入金额" step="0.01">\
            </div>\
            <span class="glyphicon glyphicon-remove pull-right text-danger btn-remove-old"></span>\
          </div>'
        );
        break;
        
      case 2:
        $('#form-account-edit').append('\
          <div class="form-group">\
            <input name="'+a_id+'[a_id]" type="hidden" value="'+a_id+'">\
            <input name="'+a_id+'[valid]" type="hidden" value="1">\
            <div class="col-xs-4">\
              <input class="form-control" name="'+a_id+'[a_name]" type="text" value="'+a_name+'" placeholder="输入名称">\
            </div>\
            <div class="col-xs-4">\
              <input class="form-control" name="'+a_id+'[money_1]" type="number" value="'+money_1+'" placeholder="输入金额" step="0.01">\
            </div>\
            <div class="col-xs-4">\
              <input class="form-control" name="'+a_id+'[money_2]" type="number" value="'+money_2+'" placeholder="输入金额" step="0.01">\
            </div>\
            <span class="glyphicon glyphicon-remove pull-right text-danger btn-remove-old"></span>\
          </div>'
        );
      break;
      
      case 3:        
        if (money_1 > 0) {
          $('hr').before('\
            <div class="form-group">\
              <input name="'+ a_id + '[a_id]" type="hidden" value="' + a_id + '">\
              <input name="'+ a_id + '[valid]" type="hidden" value="1">\
              <div class="col-xs-6">\
                <input class="form-control" name="'+ a_id + '[a_name]" type="text" value="' + a_name + '" placeholder="输入名称">\
              </div>\
              <div class="col-xs-6">\
                <input class="form-control" name="'+ a_id + '[money_1]" type="number" value="' + money_1 + '" placeholder="输入金额" step="0.01">\
              </div>\
              <span class="glyphicon glyphicon-remove pull-right text-danger btn-remove-old"></span>\
            </div>'
          );
        } else if (money_1 < 0) {
          $('#form-account-edit').append('\
            <div class="form-group">\
              <input name="'+ a_id + '[a_id]" type="hidden" value="' + a_id + '">\
              <input name="'+ a_id + '[valid]" type="hidden" value="1">\
              <div class="col-xs-6">\
                <input class="form-control" name="'+ a_id + '[a_name]" type="text" value="' + a_name + '" placeholder="输入名称">\
              </div>\
              <div class="col-xs-6">\
                <input class="form-control" name="'+ a_id + '[money_1]" type="number" value="' + money_1 + '" placeholder="输入金额" step="0.01">\
              </div>\
              <span class="glyphicon glyphicon-remove pull-right text-danger btn-remove-old"></span>\
            </div>'
          );
        }
        break;
    
      default:
        break;
    }
  }

  
  var i = 0;
  function appendNewFormControl(a_type_id) {

    var form_group = '<div class="form-group">'
    var col_4 = '<div class="col-xs-4">';
    var col_6 = '<div class="col-xs-6">';
    var div = '</div>';

    var a_name = '<input class="form-control" name="new[' + i + '][a_name]" type="text" placeholder="输入新账户名称">';
    var money_1 = '<input class="form-control" name="new[' + i + '][money_1]" type="number" placeholder="输入金额" step="0.01">';
    var money_2 = '<input class="form-control" name="new[' + i + '][money_2]" type="number" placeholder="输入金额" step="0.01">';

    var btn_remove_new = '<span class="glyphicon glyphicon-remove pull-right text-danger btn-remove-new"></span>';

    var form_control_1 = form_group + col_6 + a_name + div + col_6 + money_1 + div + btn_remove_new + div;
    var form_control_2 = form_group + col_4 + a_name + div + col_4 + money_1 + div + col_4 + money_2 + div + btn_remove_new + div;
    var form_control_3 = form_group + col_6 + a_name + div + col_6 + money_1 + div + btn_remove_new + div;

    i++;

    switch (a_type_id) {
      case 1:
        var new_form_control = form_control_1;
        break;
      case 2:
        var new_form_control = form_control_2;
        break;
      case 3:
        var new_form_control = form_control_3;
        break;

      default:
        break;
    }

    $('form').append(new_form_control);
    $('input[type="text"]').last().focus();
  }

</script>

<?php
}
