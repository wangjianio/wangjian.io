import React, { Component } from 'react';
import { Table, Popconfirm, Modal } from 'antd';
import './TransactionTable.less';

class TransactionTable extends Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false,
      dataSource: [{
        key: '1',
        type: '支出',
        account: '校园卡',
        datetime: '12-20',
        money: 20.00,
        category: '午饭',
        location: '五食堂',
        agent: '',
        remark: '炒面',
      }, {
        key: '2',
        type: '收入',
        account: '余额宝',
        datetime: '12-28',
        money: 0.1,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '3',
        type: '转账',
        account: '支付宝->余额宝',
        datetime: '12-10',
        money: 500.00,
        category: '',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '4',
        type: '支出',
        account: '微信钱包',
        datetime: '11-19',
        money: 28.5,
        category: '零食',
        location: '迅驰广场',
        agent: '',
        remark: '',
      }, {
        key: '5',
        type: '借出',
        account: '现金',
        datetime: '12-11',
        money: 200.00,
        category: '',
        location: '',
        agent: '王某某',
        remark: '',
      }, {
        key: '6',
        type: '收入',
        account: '余额宝',
        datetime: '12-26',
        money: 0.05,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '7',
        type: '收入',
        account: '余额宝',
        datetime: '12-25',
        money: 0.05,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '8',
        type: '支出',
        account: '校园卡',
        datetime: '12-23',
        money: 3.00,
        category: '水',
        location: '大购',
        agent: '',
        remark: '',
      }, {
        key: '9',
        type: '收入',
        account: '余额宝',
        datetime: '12-24',
        money: 0.04,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '10',
        type: '转账',
        account: '支付宝->工商银行（1233）',
        datetime: '12-23',
        money: 300.00,
        category: '',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '11',
        type: '支出',
        account: '微信钱包',
        datetime: '11-19',
        money: 28.5,
        category: '零食',
        location: '迅驰广场',
        agent: '',
        remark: '',
      }, {
        key: '12',
        type: '借出',
        account: '现金',
        datetime: '12-11',
        money: 220.00,
        category: '',
        location: '',
        agent: '王某某',
        remark: '',
      }, {
        key: '13',
        type: '收入',
        account: '余额宝',
        datetime: '12-23',
        money: 0.11,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '14',
        type: '收入',
        account: '余额宝',
        datetime: '12-21',
        money: 0.03,
        category: '理财',
        location: '',
        agent: '',
        remark: '',
      }, {
        key: '15',
        type: '支出',
        account: '校园卡',
        datetime: '12-23',
        money: 3.00,
        category: '水',
        location: '大购',
        agent: '',
        remark: '',
      }, {
        key: '16',
        type: '支出',
        account: '支付宝',
        datetime: '12-27',
        money: 3.00,
        category: '零食',
        location: '大购',
        agent: '',
        remark: '雪糕',
      }]
    }
  }

  onChange = (pagination, filters, sorter) => {
    console.log('params', pagination, filters, sorter);
  }

  handleDelete(key) {
    const dataSource = [...this.state.dataSource];
    this.setState({ dataSource: dataSource.filter(item => item.key !== key) });
  }

  handleCancel = () => {
    this.setState({
      visible: false
    })
  }

  handleOk = () => {
    this.setState({
      visible: false
    })
  }

  render() {
    const columns = [{
      title: '类型',
      dataIndex: 'type',
      filters: [{
        text: '支出',
        value: '支出',
      }, {
        text: '收入',
        value: '收入',
      }, {
        text: '转账',
        value: '转账',
      }, {
        text: '借入',
        value: '借入',
      }, {
        text: '偿还',
        value: '偿还',
      }, {
        text: '买入',
        value: '买入',
      }, {
        text: '卖出',
        value: '卖出',
      }],
      onFilter: (value, record) => record.type.indexOf(value) === 0,
    }, {
      title: '账户',
      dataIndex: 'account',
      filters: [{
        text: '现金',
        value: '现金',
      }, {
        text: '支付宝',
        value: '支付宝',
      }, {
        text: '校园卡',
        value: '校园卡',
      }, {
        text: '余额宝',
        value: '余额宝',
      }, {
        text: '微信钱包',
        value: '微信钱包',
      }, {
        text: '工商银行（1233）',
        value: '工商银行（1233）',
      }],
      onFilter: (value, record) => record.account.indexOf(value) === 0,
    }, {
      title: '时间',
      dataIndex: 'datetime',
      sorter: (a, b) => a.datetime.replace(/-/, '') - b.datetime.replace(/-/, ''),
      defaultSortOrder: 'descend',
    }, {
      title: '金额',
      dataIndex: 'money',
      sorter: (a, b) => a.money - b.money,
    }, {
      title: '类别',
      dataIndex: 'category',
      filters: [{
        text: '理财',
        value: '理财',
      }, {
        text: '水',
        value: '水',
      }, {
        text: '午饭',
        value: '午饭',
      }, {
        text: '零食',
        value: '零食',
      }],
      onFilter: (value, record) => record.category.indexOf(value) === 0,
    }, {
      title: '地点',
      dataIndex: 'location',
    }, {
      title: '相关人',
      dataIndex: 'agent',
    }, {
      title: '备注',
      dataIndex: 'remark',
    }, {
      title: '操作',
      dataIndex: 'operation',
      render: (text, record) => (
        <span>
          <a onClick={() => this.setState({ visible: true })} style={{ marginRight: 8 }}>编辑</a>
          <Popconfirm title="确定要删除吗？" onConfirm={() => this.handleDelete(record.key)}>
            <a>删除</a>
          </Popconfirm>
        </span>
      )
    }];

    return (
      <div className="money-transaction-table">
        <Table
          rowClassName="table-row"
          columns={columns}
          dataSource={this.state.dataSource}
          onChange={this.onChange}
        />
        <Modal
          title="编辑交易记录"
          width={640}
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
        >
        </Modal>
      </div>

    )
  }

}

export default TransactionTable;
