import React, { Component } from 'react';
import { Form, Input, Button, Col, Row, DatePicker } from 'antd';
import moment from 'moment';

const FormItem = Form.Item;

class RailwayForm extends Component {

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFields((err, values) => {
      if (!err) {
        const config = {
          method: 'get',
          mode: 'cors',
          credentials: 'omit',
        };

        const fromStationName = values.fromStationName;
        const toStationName = values.toStationName;
        const trainCode = values.trainCode;
        const trainDate = moment(values.trainDate).format('YYYY-MM-DD');

        const queryString = '?from_station_name=' + fromStationName + '&to_station_name=' + toStationName + '&train_code=' + trainCode + '&train_date=' + trainDate;
        const apiUrl = 'https://wangjian.io/api/12306/12306' + queryString;

        fetch(apiUrl, config).then(
          response => response.json(), response => this.state
        ).then(
          json => this.handleFetchSuccess(json),
        )
      }
    });
  }

  // 向父组件传递结果
  handleFetchSuccess = json => this.props.transferInfo(json);

  render() {
    const { getFieldDecorator } = this.props.form;

    // 过了中午 12 点，默认日期加 1 天
    const initialTrainDate = new Date().getHours() < 12 ? moment() : moment().add(1, 'days');

    return (
      <Form layout='vertical' onSubmit={this.handleSubmit}>
        <Row gutter={16}>
          <Col sm={12}>
            <FormItem label='出发站'>
              {getFieldDecorator('fromStationName', {
                rules: [{ required: true, whitespace: true, message: '请输入出发站' }],
              })(
                <Input placeholder="北京南" autoComplete="off" />
                )}
            </FormItem>
          </Col>
          <Col sm={12}>
            <FormItem label='到达站'>
              {getFieldDecorator('toStationName', {
                rules: [{ required: true, whitespace: true, message: '请输入到达站' }],
              })(
                <Input placeholder="上海虹桥" autoComplete="off" />
                )}
            </FormItem>
          </Col>
        </Row>
        <Row gutter={16}>
          <Col sm={12}>
            <FormItem label='车次'>
              {getFieldDecorator('trainCode', {
                rules: [{ required: true, pattern: /[A-Z]?\d+/, message: '请输入车次' }],
              })(
                <Input placeholder="G1" autoComplete="off" />
                )}
            </FormItem>
          </Col>
          <Col sm={12}>
            <FormItem label='出发日期'>
              {getFieldDecorator('trainDate', {
                rules: [{ required: true, message: '请选择出发日期' }],
                initialValue: initialTrainDate,
              })(
                <DatePicker allowClear={false} style={{ width: '100%' }} />
                )}
            </FormItem>
          </Col>
        </Row>
        <Row>
          <Col>
            <Button type="primary" htmlType="submit" size="large" style={{ width: '100%' }}>查询</Button>
          </Col>
        </Row>
      </Form>
    );
  }
}

export default Form.create()(RailwayForm);
