import React, { Component } from 'react';
import { Row, Tabs } from 'antd';
import CategoryTree from '../../../components/Money/CategoryTree';
const TabPane = Tabs.TabPane;

class Category extends Component {
  render() {
    return (
      <div className="money-category">
        <Row>
          <Tabs defaultActiveKey="1">
            <TabPane tab="支出类别" key="1">
              <CategoryTree type='out' />
            </TabPane>
            <TabPane tab="收入类别" key="2">
              <CategoryTree type='in' />
            </TabPane>
          </Tabs>
        </Row>

      </div>
    )
  }
}

export default Category;
