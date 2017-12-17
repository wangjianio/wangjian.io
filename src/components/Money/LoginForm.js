import React, { Component } from 'react';
import { Form, Icon, Input, Button, Checkbox } from 'antd';
import './LoginForm.less';
const FormItem = Form.Item;

class LoginForm extends Component {
  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFields((err, values) => {
      if (!err) {
        console.log('Received values of form: ', values);
      }
    });
  }
  render() {
    const { getFieldDecorator } = this.props.form;

    return (
      <Form onSubmit={this.handleSubmit} className="money-login-form">
        <FormItem>
          {getFieldDecorator('userName', {
            rules: [{ required: true, message: '请输入邮箱或用户名！' }],
          })(
            <Input size="large" prefix={<Icon type="user" />} placeholder="邮箱／用户名" autoComplete="off" />
            )}
        </FormItem>
        <FormItem>
          {getFieldDecorator('password', {
            rules: [{ required: true, message: '请输入密码！' }],
          })(
            <Input size="large" prefix={<Icon type="lock" />} type="password" placeholder="密码" autoComplete="off" />
            )}
        </FormItem>
        <Button className="login" size="large" type="primary" htmlType="submit">
          登录
          </Button>
        <FormItem style={{ marginBottom: 0 }}>
          {getFieldDecorator('remember', {
            valuePropName: 'checked',
            initialValue: true,
          })(
            <Checkbox>下次自动登录</Checkbox>
            )}
          <div className="account-action">
            <a className="forgot" href="">忘记密码</a>
            <a className="signup" href="">注册</a>
          </div>
        </FormItem>
      </Form>
    );
  }
}

export default Form.create()(LoginForm);
