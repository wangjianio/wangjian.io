import React, { Component } from 'react';
import { Row, Col, Input, Form, Table, message } from 'antd';
import copy from 'copy-to-clipboard';
import PageTitle from '../../components/PageTitle';
import './CetJilin.less';

class CetJilin extends Component {
  constructor(props) {
    super(props);
    this.state = {
      validateStatus: '',
      help: '',
      tableDisplay: false,
      dataSource: {
        name: '',
        idNumber: '',
        certificate: '',
      }
    }
  }

  handleSearch = (value) => {
    const formData = new FormData();
    formData.append('idNumber', value);

    const config = {
      method: 'post',
      mode: 'cors',
      credentials: 'omit',
      body: formData,
    };

    fetch('https://wangjian.io/api/cet/jilin', config).then(
      response => response.json(), () => { message.error('获取信息失败，请稍后重试') }
    ).then(
      json => this.handleFetchSuccess(json),
    )
  }

  handleFetchSuccess = json => {
    if (json.result) {
      message.success('查询成功！');
      this.setState({
        tableDisplay: true,
        dataSource: {
          name: json.data.name,
          idNumber: json.data.idNumber,
          certificate: json.data.certificate,
        }
      });
    } else {
      this.setState({
        tableDisplay: false,
      });
      message.error(json.error);
    }
  }

  handleCopyLinkClick = record => {
    if (copy(record.result)) {
      message.success('复制成功：' + record.result);
    } else {
      message.error('复制失败，请手动复制。')
    }
  }

  render() {
    const dataSource = [{
      key: 'name',
      header: '考生姓名：',
      result: this.state.dataSource.name,
    }, {
      key: 'idNumber',
      header: '身份证号：',
      result: this.state.dataSource.idNumber,
    }, {
      key: 'certificate',
      header: '准考证号：',
      result: this.state.dataSource.certificate,
    }];

    const columns = [{
      dataIndex: 'header',
      key: 'header',
      width: '100px',
    }, {
      dataIndex: 'result',
      key: 'result',
    }, {
      className: 'action',
      dataIndex: 'action',
      key: 'action',
      width: '64px',
      render: (text, record, index) => (
        <a onClick={() => this.handleCopyLinkClick(record)}>复制</a>
      ),
    }];

    return (
      <Row className="cet" >
        <PageTitle title="吉林省 CET 准考证号查询" />
        <Col style={{ maxWidth: 640 }}>
          <Form>
            <Form.Item validateStatus={this.state.validateStatus} help={this.state.help}>
              <Input.Search
                placeholder="输入身份证号"
                enterButton="查询"
                size="large"
                onSearch={value => this.handleSearch(value)}
              />
            </Form.Item>
          </Form>
          {this.state.tableDisplay &&
            <Table
              dataSource={dataSource}
              columns={columns}
              bordered
              size="small"
              pagination={false}
              showHeader={false}
            />
          }
        </Col>
      </Row>
    )
  }
}

export default CetJilin;
