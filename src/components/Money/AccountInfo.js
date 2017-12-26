import React, { Component } from 'react';
import { Table, Input, Popconfirm, Button } from 'antd';
import './AccountInfo.less';

const EditableCell = ({ editable, value, onChange }) => (
  <div>
    {editable
      ? <Input style={{ margin: '-5px 0' }} value={value} onChange={e => onChange(e.target.value)} />
      : value
    }
  </div>
);

class AccountInfo extends Component {
  constructor(props) {
    super(props);
    this.state = {
      dataSource: [],
      newAccountCount: 0,
    }
  }

  componentWillMount() {
    for (let i = 0; i < 7; i++) {
      this.state.dataSource.push({
        key: i.toString(),
        accountName: `Edrward ${i}`,
        money1: i,
        money2: i,
        money3: i,
        money4: i,
      });
    }
    this.cacheData = this.state.dataSource.map(item => ({ ...item }));
  }

  renderColumn(text, record, column) {
    return (
      <EditableCell
        editable={record.editable}
        value={text}
        onChange={value => this.handleChange(value, record.key, column)}
      />
    )
  }

  handleAdd = () => {
    const newData = {
      key: 'newAccount' + this.state.newAccountCount,
      editable: true,
    };
    this.setState({
      dataSource: [...this.state.dataSource, newData],
      newAccountCount: this.state.newAccountCount + 1
    });
  }

  handleEdit(key) {
    const newData = [...this.state.dataSource];
    const target = newData.filter(item => key === item.key)[0];
    if (target) {
      target.editable = true;
      this.setState({ dataSource: newData });
    }
  }

  handleDelete(key) {
    const dataSource = [...this.state.dataSource];
    this.setState({ dataSource: dataSource.filter(item => item.key !== key) });
  }

  handleSave(key) {
    const newData = [...this.state.dataSource];
    const target = newData.filter(item => key === item.key)[0];
    if (target) {
      delete target.editable;
      this.setState({ dataSource: newData });
      this.cacheData = newData.map(item => ({ ...item }));
    }
  }

  handleCancel(key) {
    const newData = [...this.state.dataSource];
    const target = newData.filter(item => key === item.key)[0];
    if (target) {
      Object.assign(target, this.cacheData.filter(item => key === item.key)[0]);
      delete target.editable;
      this.setState({ dataSource: newData });
    }
  }

  handleChange(value, key, column) {
    const newData = [...this.state.dataSource];
    const target = newData.filter(item => key === item.key)[0];
    if (target) {
      target[column] = value;
      this.setState({ dataSource: newData });
    }
  }

  render() {
    const { accountType } = this.props;
    let columns;
    let accountTypeDesc;

    const accountName = {
      title: '账户名称',
      width: '30%',
      dataIndex: 'accountName',
      render: (text, record) => this.renderColumn(text, record, 'accountName'),
    }

    const money1 = {
      title: '余额',
      width: '60%',
      dataIndex: 'money1',
      render: (text, record) => this.renderColumn(text, record, 'money1'),
    }

    const money2 = {
      title: '欠款',
      width: '30%',
      dataIndex: 'money2',
      render: (text, record) => this.renderColumn(text, record, 'money2'),
    }

    const money3 = {
      title: '额度',
      width: '30%',
      dataIndex: 'money3',
      render: (text, record) => this.renderColumn(text, record, 'money3'),
    }

    const money4 = {
      title: '价值',
      width: '60%',
      dataIndex: 'money4',
      render: (text, record) => this.renderColumn(text, record, 'money4'),
    }

    const operation = {
      title: '操作',
      width: '100px',
      dataIndex: 'operation',
      render: (text, record) => (
        <div>
          {
            record.editable ?
              <span>
                <a onClick={() => { this.handleSave(record.key) }} style={{ marginRight: 8 }}>保存</a>
                <a onClick={() => { this.handleCancel(record.key) }}>取消</a>
              </span> :
              <span>
                <a onClick={() => { this.handleEdit(record.key) }} style={{ marginRight: 8 }}>编辑</a>
                <Popconfirm title="确定要删除吗？" onConfirm={() => this.handleDelete(record.key)}>
                  <a>删除</a>
                </Popconfirm>
              </span>
          }
        </div>
      )
    }

    // 0: 借记账户
    // 1: 借贷账户
    // 2: 资产
    // 3: 负债
    if (accountType === 0) {
      columns = [accountName, money1, operation];
      accountTypeDesc = '借记账户';
    } else if (accountType === 1) {
      accountTypeDesc = '借贷账户';
      columns = [accountName, money2, money3, operation];
    } else if (accountType === 2) {
      accountTypeDesc = '资产账户';
      columns = [accountName, money4, operation];
    } else if (accountType === 3) {
      accountTypeDesc = '负债账户';
      columns = [accountName, money4, operation];
    }


    return (
      <div className="money-account-info">
        <div className="head">
          <span className="head-text" >{accountTypeDesc}</span>
          <Button size="small" onClick={this.handleAdd}>新增</Button>
        </div>
        <Table
          rowClassName="table-row"
          columns={columns}
          dataSource={this.state.dataSource}
        />
      </div>
    )
  }
}

export default AccountInfo;
