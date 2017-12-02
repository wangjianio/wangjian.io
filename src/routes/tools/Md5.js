import React, { Component } from 'react';
import { Row, Col, Input, Card, message } from 'antd';
import PageTitle from '../../components/PageTitle';
import Hashes from 'jshashes';
import copy from 'copy-to-clipboard';
import './Md5.less';

class Time extends Component {
  constructor(props) {
    super(props);
    this.state = {
      hashedText: ''
    }

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleCopyLinkClick = this.handleCopyLinkClick.bind(this);
  }

  componentDidMount() {
    const MD5 = new Hashes.MD5().hex('');
    this.setState({
      hashedText: MD5
    })
  }

  handleInputChange(e) {
    const MD5 = new Hashes.MD5().hex(e.target.value);
    this.setState({
      hashedText: MD5
    })
  };

  handleCopyLinkClick() {
    if (copy(this.state.hashedText)) {
      message.success('复制成功！');
    } else {
      message.error('复制失败，请手动复制。');
    }
  }

  render() {
    // const selectAfter = (
    //   <Select defaultValue="MD5">
    //     <Select.Option value="MD5">MD5</Select.Option>
    //     <Select.Option value="SHA-256">SHA-256</Select.Option>
    //   </Select>
    // );

    return (
      <Row>
        <PageTitle title="MD5 值生成器" />
        <Col sm={16} md={12}>
          <Input className="input" size="large" onChange={this.handleInputChange} placeholder="直接输入字符串" />
          <Card style={{ marginTop: 24 }}>
            <pre style={{ display: 'inline' }}>{this.state.hashedText}</pre>
            <a onClick={this.handleCopyLinkClick} style={{ float: 'right' }}>复制</a>
          </Card>
        </Col>
      </Row >
    );
  }
}

export default Time;
