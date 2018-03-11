import React, { Component } from 'react';
import { Tabs } from 'antd';
import ChartPieLabelLine from '../../../components/Money/ChartPieLabelLine';
import ChartBarGroupedColumn from '../../../components/Money/ChartBarGroupedColumn';

const TabPane = Tabs.TabPane;

class Statistics extends Component {

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
