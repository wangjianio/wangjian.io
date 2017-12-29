import React, { Component } from 'react';
import { Tabs, message } from 'antd';
import ChartPieLabelLine from '../../../components/Money/ChartPieLabelLine';
import ChartBarGroupedColumn from '../../../components/Money/ChartBarGroupedColumn';

const TabPane = Tabs.TabPane;

class Statistics extends Component {

  componentWillMount() {
    message.error('网络错误');
  }

  componentDidMount() {
    setTimeout(
      () => {
        message.error('网络错误');
      }, 200
    )
    message.error('网络错误');

  }

  render() {

    return (
      <div className="money-Statistics">
        <Tabs defaultActiveKey="1">
          <TabPane tab="支出占比" key="1">
            <ChartPieLabelLine type='out' />
          </TabPane>
          <TabPane tab="收入占比" key="2">
            <ChartPieLabelLine type='in' />
          </TabPane>
          <TabPane tab="支出收入情况" key="3">
            <ChartBarGroupedColumn />
          </TabPane>
        </Tabs>
      </div>
    )
  }
}

export default Statistics;
