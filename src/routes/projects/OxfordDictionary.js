import React, { Component } from 'react';
import { Row, Col, Input, Form, Table, message, List } from 'antd';
import copy from 'copy-to-clipboard';
import PageTitle from '../../components/PageTitle';
import './CetJilin.less';

class OxfordDictionary extends Component {
  constructor(props) {
    super(props);
    this.state = {
      validateStatus: '',
      help: '',
      tableDisplay: false,
      tableData: {
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
        tableData: {
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
    const tableData = [{
      key: 'name',
      header: '考生姓名：',
      result: this.state.tableData.name,
    }, {
      key: 'idNumber',
      header: '身份证号：',
      result: this.state.tableData.idNumber,
    }, {
      key: 'certificate',
      header: '准考证号：',
      result: this.state.tableData.certificate,
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

    const listData = [
      <span>基于牛津大学出版社的 <a href="https://developer.oxforddictionaries.com" target="_blank" rel="noopener noreferrer">Oxford Dictionaries API</a> 制作，主要用来快速学习单词发音。</span>,
      <span>目前仅显示英式发音，美式发音会在将来支持。</span>,
      <span>由于 API 速度原因，查询时稍微有点慢，请耐心等待。</span>,
    ]

    return (
      <div>
        <PageTitle title="Oxford Dictionaries 英语发音" />
        <Row className="cet" type="flex" justify="space-between">
          <Col style={{ maxWidth: 640, width: '100%' }}>
            <Form>
              <Form.Item validateStatus={this.state.validateStatus} help={this.state.help}>
                <Input.Search
                  placeholder="输入单词"
                  enterButton="查询"
                  size="large"
                  onSearch={value => this.handleSearch(value)}
                />
              </Form.Item>
            </Form>
            {this.state.tableDisplay &&
              <Table
                dataSource={tableData}
                columns={columns}
                bordered
                size="small"
                pagination={false}
                showHeader={false}
              />
            }
          </Col>
          <Col xs={24} xxl={10}>
            <List
              header={<strong>说明：</strong>}
              bordered
              dataSource={listData}
              renderItem={item => <List.Item>{item}</List.Item>}
              style={{ maxWidth: 640, width: '100%' }}
            />
          </Col>
        </Row>
      </div>
    )
  }
}

export default OxfordDictionary;
