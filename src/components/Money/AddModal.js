import React, { Component } from 'react';
import { Modal, Form, DatePicker, Select, Input, InputNumber, message } from 'antd';
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
      confirmLoading: true,
    });
    setTimeout(() => {
      this.setState({
        visible: false,
        confirmLoading: false,
      });
      message.error('添加失败：请求超时')
    }, 5000);
  }

  render() {
    const { getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 4 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 18 },
      },
    };
    const config = {
      rules: [{ type: 'object', required: true, message: '请选择时间！' }],
    };
    return (
      <div className="money-add-modal">
        <Modal
          title="添加交易"
          width={640}
          confirmLoading={this.state.confirmLoading}
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
              {getFieldDecorator('type', {
                rules: [
                  { required: true, message: '请选择类型！' },
                ],
              })(
                <Select placeholder="请选择交易类型">
                  <Option value="out">支出</Option>
                  <Option value="in">收入</Option>
                  <Option value="transfer">转账</Option>
                  <Option value="borrow">借入债务</Option>
                  <Option value="pay">偿还债务</Option>
                  <Option value="buy">买入资产</Option>
                  <Option value="sell">卖出资产</Option>
                </Select>
                )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="账户"
              hasFeedback
            >
              {getFieldDecorator('account', {
                rules: [
                  { required: true, message: '请选择账户！' },
                ],
              })(
                <Select placeholder="请选择一个账户" >
                  <Option value="cash">现金</Option>
                  <Option value="alipay">支付宝</Option>
                  <Option value="yuebao">余额宝</Option>
                  <Option value="huabei">蚂蚁花呗</Option>
                  <Option value="huabei">工商银行（1233）</Option>
                </Select>
                )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="类别"
              hasFeedback
            >
              {getFieldDecorator('category', {
                rules: [
                  { required: true, message: '请选择类别！' },
                ],
              })(
                <Select placeholder="请选择一个类别" >
                  <Option value="cash">午饭</Option>
                  <Option value="alipay">零食</Option>
                  <Option value="yuebao">衣服</Option>
                  <Option value="huabei">出行</Option>
                  <Option value="huabei">理财</Option>
                </Select>
                )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="金额"
              hasFeedback
            >
              {getFieldDecorator('input-number', {
                rules: [
                  { required: true, message: '请输入金额！' },
                ], initialValue: 0.00
              })(
                <InputNumber />
                )}
              <span className="ant-form-text">元</span>
            </FormItem>
            <FormItem
              {...formItemLayout}
              hasFeedback
              label="时间"
            >
              {getFieldDecorator('date-time-picker', config)(
                <DatePicker showTime format="YYYY-MM-DD HH:mm:ss" />
              )}
            </FormItem>
            <FormItem {...formItemLayout} label="地点">
              <Input placeholder="请输入交易地点" />
            </FormItem>
            <FormItem {...formItemLayout} label="备注">
              <Input placeholder="请输入备注" />
            </FormItem>
          </Form>
        </Modal>
      </div>
    )
  }
}

export default Form.create()(AddModal);
