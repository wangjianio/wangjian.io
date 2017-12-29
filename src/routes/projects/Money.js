import React, { Component } from 'react';
import { Layout, Menu, Icon } from 'antd';
import { Route } from 'react-router';
import { NavLink } from 'react-router-dom';
import { Login, MoneyIndex, Account, Transaction, Category, Statistics, Setting } from './Money/';
import AddModal from '../../components/Money/AddModal';

class Money extends Component {
  constructor(props) {
    super(props);
    this.state = {
      addModalVisible: false
    }
  }

  componentWillReceiveProps() {
    this.setState({
      addModalVisible: false
    })
  }

  render() {
    const { pathname } = this.props.location;
    let selectedKeys = pathname;

    return (
      <Layout style={{ width: '100vw', height: 'calc(100vh - 48px' }}>
        <Layout.Sider style={{ overflow: 'auto', height: 'calc(100vh - 48px - 40px)' }}>
          <Menu theme="dark" mode="inline" selectedKeys={[selectedKeys]}>
            <Menu.Item>
              <a onClick={() => { this.setState({ addModalVisible: true }) }}><Icon type="plus" />新增交易</a>
            </Menu.Item>
            <Menu.Item key="/projects/money/index">
              <NavLink to="/projects/money/index"><Icon type="home" />概览</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/account">
              <NavLink to="/projects/money/account"><Icon type="credit-card" />账户管理</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/transaction">
              <NavLink to="/projects/money/transaction"><Icon type="profile" />交易记录</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/category">
              <NavLink to="/projects/money/category"><Icon type="appstore-o" />类别管理</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/statistics">
              <NavLink to="/projects/money/statistics"><Icon type="line-chart" />统计</NavLink>
            </Menu.Item>
            <Menu.Item key="/projects/money/setting">
              <NavLink to="/projects/money/setting"><Icon type="setting" />账号设置</NavLink>
            </Menu.Item>
          </Menu>
        </Layout.Sider>
        <Layout>
          <Layout.Content style={{ padding: 32 }}>
            <AddModal visible={this.state.addModalVisible} />
            <Route path="/projects/money/login" component={Login} />
            <Route path="/projects/money/index" component={MoneyIndex} />
            <Route path="/projects/money/account" component={Account} />
            <Route path="/projects/money/transaction" component={Transaction} />
            <Route path="/projects/money/category" component={Category} />
            <Route path="/projects/money/statistics" component={Statistics} />
            <Route path="/projects/money/setting" component={Setting} />
          </Layout.Content>
        </Layout>
      </Layout>
    )
  }
}

export default Money;
