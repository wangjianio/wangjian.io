import React, { Component } from 'react';
import { Row, Col } from 'antd';
import PageTitle from '../components/PageTitle';

class Home extends Component {
  render() {
    return (
      <Row>
        <PageTitle title="主页" />
        <Col sm={12}>
          <p>使用 React、Antd 等重构了之前用 PHP 写的网站。</p>
        </Col>
      </Row>
    )
  }
}

export default Home;
