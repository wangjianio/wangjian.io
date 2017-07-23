function inputCheck(addUserForm) {
    if (!addUserForm.name.value) {
        alert("请输入姓名!");
        addUserForm.name.focus();
        return (false);
    }
    if (!addUserForm.gender.value) {
        alert("请选择性别!");
        return (false);
    }
    if (!addUserForm.tel.value) {
        alert("请输入电话!");
        addUserForm.tel.focus();
        return (false);
    }
    if (!addUserForm.id_number.value) {
        alert("请输入身份证号!");
        addUserForm.id_number.focus();
        return (false);
    }
}