import React, { Component } from 'react';
import { Modal, Form, DatePicker, Select, Input, InputNumber } from 'antd';
// import AccountInfo from '../../../components/Money/Transaction';

const FormItem = Form.Item;
const { Option } = Select;

class AddModal extends Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false
    }
  }

  componentWillReceiveProps(nextProps) {
    this.setState({
      visible: nextProps.visible
    })
  }

  handleCancel = () => {
    this.setState({
      visible: false
    })
  }

  handleOk = () => {
    this.setState({
      visible: false
    })
  }

  render() {
    const { getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 8 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 16 },
      },
    };
    const config = {
      rules: [{ type: 'object', required: true, message: 'Please select time!' }],
    };
    return (
      <div className="money-add-modal">
        <Modal
          title="添加交易"
          width={640}
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
        >
          <Form onSubmit={this.handleSubmit}>
            <FormItem
              {...formItemLayout}
              label="类型"
              hasFeedback
            >
              {getFieldDecorator('select', {
                rules: [
                  { required: true, message: 'Please select your country!' },
                ],
              })(
                <Select placeholder="Please select a country">
                  <Option value="china">China</Option>
                  <Option value="use">U.S.A</Option>
                </Select>
                )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="账户"
              hasFeedback
            >
              {getFieldDecorator('select', {
                rules: [
                  { required: true, message: 'Please select your country!' },
                ],
              })(
                <Select placeholder="Please select a country">
                  <Option value="china">China</Option>
                  <Option value="use">U.S.A</Option>
                </Select>
                )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="金额"
            >
              {getFieldDecorator('input-number', { initialValue: 3 })(
                <InputNumber min={1} max={10} />
              )}
              <span className="ant-form-text"> machines</span>
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="时间"
            >
              {getFieldDecorator('date-time-picker', config)(
                <DatePicker showTime format="YYYY-MM-DD HH:mm:ss" />
              )}
            </FormItem>
            <FormItem {...formItemLayout} label="地点">
              {getFieldDecorator('nickname', {
                rules: [{
                  required: this.state.checkNick,
                  message: 'Please input your nickname',
                }],
              })(
                <Input placeholder="Please input your nickname" />
                )}
            </FormItem>
            <FormItem {...formItemLayout} label="备注">
              {getFieldDecorator('nickname', {
                rules: [{
                  required: this.state.checkNick,
                  message: 'Please input your nickname',
                }],
              })(
                <Input placeholder="Please input your nickname" />
                )}
            </FormItem>
          </Form>
        </Modal>
      </div>
    )
  }
}

export default Form.create()(AddModal);
