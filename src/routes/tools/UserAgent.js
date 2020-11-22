import React, { Component } from 'react';
import { Row, Col, Card } from 'antd';
import PageTitle from '../../components/PageTitle';

class UserAgent extends Component {
  constructor(props) {
    super(props);
    this.state = {
      userAgent: window.navigator.userAgent,
    }
  }

  render() {
    return (
      <Row>
        <PageTitle title="当前浏览器设定的 User Agent" />
        <Col>
          <Card>
            {this.state.userAgent}
          </Card>
        </Col>
      </Row>
    )
  }
}

export default UserAgent;
