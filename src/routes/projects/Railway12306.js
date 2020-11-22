import React, { Component } from 'react';
import { Row, Col, Timeline, message, Icon } from 'antd';
import PageTitle from '../../components/PageTitle';
import RailwayForm from '../../components/RailwayForm';
import './Railway12306.less';

class Railway12306 extends Component {
  constructor(props) {
    super(props);
    this.state = {
      displayTimeline: false,
      info: {}
    }
  }

  transferInfo = (info) => {
    if (info.result) {
      this.setState({
        displayTimeline: true,
        info: info,
      })
    } else {
      this.setState({
        displayTimeline: false
      })
      message.error('查询失败，请检查输入。');
    }
  }

  render() {
    return (
      <Row className="railway12306">
        <PageTitle title="12306 信息查询" />
        <Col sm={12}>
          <RailwayForm transferInfo={info => this.transferInfo(info)} />
        </Col>
        {this.state.displayTimeline ?
          <Col sm={12}>
            <Timeline>
              <Timeline.Item><strong>出发时间：</strong>{this.state.info.start_datetime}</Timeline.Item>
              <Timeline.Item dot={<Icon type="clock-circle-o" />}><strong>历　　时：</strong>{this.state.info.last_time}</Timeline.Item>
              <Timeline.Item><strong>到达时间：</strong>{this.state.info.arrive_datetime}</Timeline.Item>
            </Timeline>
          </Col>
          : null}
      </Row>
    )
  }
}

export default Railway12306;
