import React, { Component } from 'react';
import { Row, Col, Card } from 'antd';
import CategoryTree from '../../../components/Money/CategoryTree';

class Category extends Component {
  render() {
    return (
      <div className="money-category">
        <Row>
          <Col span={12}>
            <Card>
              <CategoryTree />
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default Category;
