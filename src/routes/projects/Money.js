import React, { Component } from 'react';
import { Row, Col } from 'antd';
import PageTitle from '../../components/PageTitle';

class Money extends Component {
  constructor(props) {
    super(props);
    this.state = {
    }
  }

  render() {
    return (
      <Row>
        <PageTitle title="当前" />
        <Col>
        </Col>
      </Row>
    )
  }
}

export default Money;
