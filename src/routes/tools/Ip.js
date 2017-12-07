import React, { Component } from 'react';
import { Row, Col, Card } from 'antd';
import PageTitle from '../../components/PageTitle';

class Ip extends Component {
  constructor(props) {
    super(props);
    this.state = {
      result: '0.0.0.0'
    };

    this.handleFetchSuccess = this.handleFetchSuccess.bind(this);
  }

  componentDidMount() {
    const config = {
      method: 'get',
      mode: 'cors',
      credentials: 'omit',
      headers: {
        // cache: 'reload'
        // 'Content-Type': 'text/plain',
      },
    };

    fetch('https://wangjian.io/api/ip/', config).then(
      response => response.json(), response => this.state
    ).then(
      json => this.handleFetchSuccess(json),
    )
  }

  handleFetchSuccess(json) {
    this.setState({
      ip: json.result
    });
  }

  render() {
    return (
      <Row>
        <PageTitle title="当前的 IP 地址是" />
        <Col>
          <Card>
            <pre style={{ display: 'inline' }}>{this.state.ip}</pre>
          </Card>
        </Col>
      </Row>
    )
  }
}

export default Ip;
