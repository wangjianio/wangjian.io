import React, { Component } from 'react';
import { Layout, Menu, Icon } from 'antd';
import { Route } from 'react-router';
import { NavLink } from 'react-router-dom';
import { Login, Add, MoneyIndex, Account, Transaction, Category, Setting } from './Money/';

class Money extends Component {
  constructor(props) {
    super(props);
    this.state = {
    }
  }

  render() {
    const { pathname } = this.props.location;
    let selectedKeys = pathname;

    return (
      <Layout style={{ width: '100vw', height: 'calc(100vh - 48px' }}>
        <Layout.Sider style={{ overflow: 'auto', height: 'calc(100vh - 48px - 40px)' }}>
          <Menu theme="dark" mode="inline" selectedKeys={[selectedKeys]}>
            <Menu.Item key="/projects/money/add">
              <NavLink to="/projects/money/add"><Icon type="plus" />新增交易</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/index">
              <NavLink to="/projects/money/index"><Icon type="user" />概览</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/account">
              <NavLink to="/projects/money/account"><Icon type="user" />账户管理</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/transaction">
              <NavLink to="/projects/money/transaction"><Icon type="user" />交易记录</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/category">
              <NavLink to="/projects/money/category"><Icon type="user" />类别管理</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/setting">
              <NavLink to="/projects/money/setting"><Icon type="user" />账户设置</NavLink>
            </Menu.Item>
          </Menu>
        </Layout.Sider>
        <Layout>
          <Layout.Content style={{ padding: 32 }}>
            <Route path="/projects/money/login" component={Login} />
            <Route path="/projects/money/index" component={MoneyIndex} />
            <Route path="/projects/money/add" component={Add} />
            <Route path="/projects/money/account" component={Account} />
            <Route path="/projects/money/transaction" component={Transaction} />
            <Route path="/projects/money/category" component={Category} />
            <Route path="/projects/money/setting" component={Setting} />
          </Layout.Content>
        </Layout>
      </Layout>
    )
  }
}

export default Money;
