function appendAddForm(a_type) {

    var formGroup = '<div class="form-group">'
    var col4 = '<div class="col-xs-4">';
    var col6 = '<div class="col-xs-6">';
    var div = '</div>';

    var accountName = '<input class="form-control" name="new[accountName][]" type="text" placeholder="输入新账户名称">';
    var money_1 = '<input class="form-control" name="new[money1][]" type="number" placeholder="输入金额" step="0.01">';
    var money_2 = '<input class="form-control" name="new[money2][]" type="number" placeholder="输入金额" step="0.01">';

    var asset = formGroup + col6 + accountName + div + col6 + money_1 + div + div;
    var credit = formGroup + col4 + accountName + div + col4 + money_1 + div + col4 + money_2 + div + div;
    var debit = formGroup + col6 + accountName + div + col6 + money_1 + div + div;

    switch (a_type) {
        case 'asset':
            var txt = asset;
            break;
        case 'credit':
            var txt = credit;
            break;
        case 'debit':
            var txt = debit;
            break;
    
        default:
            break;
    }
    
    $('form').append(txt);
    $('input[type=text]').last().focus();
}

function delAccount(a_type, a_id) {
    $('input[name="' + a_type + '[' + a_id + '][a_name]"]').parent().parent().css('display', 'none');
}