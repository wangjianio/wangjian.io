import React, { Component } from 'react';
import { Row, Col, Table, Slider, message } from 'antd';
import copy from 'copy-to-clipboard';
import PageTitle from '../../components/PageTitle';

class Time extends Component {
  constructor(props) {
    super(props);
    this.state = {
      frequency: 1000,
      date: new Date(),
    };

    this.handleSliderChange = this.handleSliderChange.bind(this);
  };

  componentDidMount() {
    this.timerID = setInterval(
      () => this.setNewDate(),
      this.state.frequency
    );
  }

  componentDidUpdate() {
    clearInterval(this.timerID);
    this.timerID = setInterval(
      () => this.setNewDate(),
      this.state.frequency
    );
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  setNewDate() {
    this.setState({
      date: new Date()
    });
  }

  handleSliderChange(value) {
    this.setState({
      frequency: value
    });
  }

  handleCopyLinkClick = (record) => {
    const timeText = record.time;

    if (copy(timeText)) {
      message.success('复制成功：' + timeText);
    } else {
      message.error('复制失败，请手动复制。')
    }
  }

  render() {

    const columns = [{
      key: 'formate',
      title: '格式',
      dataIndex: 'formate',
    }, {
      key: 'time',
      title: '时间',
      dataIndex: 'time',
    }, {
      key: 'action',
      title: '操作',
      width: 61,
      render: (text, record, index) => (
        <a onClick={() => this.handleCopyLinkClick(record)}>复制</a>
      )
    }];

    const dataSource = [{
      key: 1,
      formate: 'Unix time',
      time: this.state.date.getTime(),
    }, {
      key: 2,
      formate: 'CST',
      time: this.state.date.toString(),
    }, {
      key: 3,
      formate: 'ISO',
      time: this.state.date.toISOString(),
    }, {
      key: 4,
      formate: 'Locale',
      time: this.state.date.toLocaleString(),
    }, {
      key: 5,
      formate: 'GMT',
      time: this.state.date.toGMTString(),
    }];

    return (
      <Row>
        <PageTitle title="时间" />
        <Col sm={15}>
          <Table
            bordered
            columns={columns}
            dataSource={dataSource}
            pagination={false}
          />
        </Col>
        <Col sm={{ span: 8, offset: 1 }}>
          大致更新时间（毫秒）：
          <Slider
            defaultValue={1000}
            max={3000}
            onChange={this.handleSliderChange}
          />
        </Col>
      </Row>
    );
  }
}

export default Time;
