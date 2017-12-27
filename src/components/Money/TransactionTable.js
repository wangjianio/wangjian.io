import React, { Component } from 'react';
import { Table, Popconfirm } from 'antd';
import './TransactionTable.less';

class TransactionTable extends Component {
  constructor(props) {
    super(props);
    this.state = {

    }
  }

  onChange = (pagination, filters, sorter) => {
    console.log('params', pagination, filters, sorter);
  }

  render() {
    const columns = [{
      title: '类型',
      dataIndex: 'type',
      filters: [{
        text: 'Joe',
        value: 'Joe',
      }, {
        text: 'Jim',
        value: 'Jim',
      }, {
        text: 'Submenu',
        value: 'Submenu',
        children: [{
          text: 'Green',
          value: 'Green',
        }, {
          text: 'Black',
          value: 'Black',
        }],
      }],
      // specify the condition of filtering result
      // here is that finding the name started with `value`
      onFilter: (value, record) => record.name.indexOf(value) === 0,
      sorter: (a, b) => a.name.length - b.name.length,
    }, {
      title: '账户',
      dataIndex: 'account',
      defaultSortOrder: 'descend',
      sorter: (a, b) => a.age - b.age,
    }, {
      title: '时间',
      dataIndex: 'datetime',
      filters: [{
        text: 'London',
        value: 'London',
      }, {
        text: 'New York',
        value: 'New York',
      }],
      filterMultiple: false,
      onFilter: (value, record) => record.address.indexOf(value) === 0,
      sorter: (a, b) => a.address.length - b.address.length,
    }, {
      title: '金额',
      dataIndex: 'money'
    }, {
      title: '类别',
      dataIndex: 'category',
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
          <a onClick={() => { this.handleEdit(record.key) }} style={{ marginRight: 8 }}>编辑</a>
          <Popconfirm title="确定要删除吗？" onConfirm={() => this.handleDelete(record.key)}>
            <a>删除</a>
          </Popconfirm>
        </span>
      )
    }];

    const dataSource = [{
      key: '1',
      name: 'John Brown',
      age: 32,
      address: 'New York No. 1 Lake Park',
    }, {
      key: '2',
      name: 'Jim Green',
      age: 42,
      address: 'London No. 1 Lake Park',
    }, {
      key: '3',
      name: 'Joe Black',
      age: 32,
      address: 'Sidney No. 1 Lake Park',
    }, {
      key: '4',
      name: 'Jim Red',
      age: 32,
      address: 'London No. 2 Lake Park',
    }];

    return (
      <div className="money-transaction-table">
        <Table
          rowClassName="table-row"
          columns={columns}
          dataSource={dataSource}
          onChange={this.onChange}
        />
      </div>
    )
  }

}

export default TransactionTable;
