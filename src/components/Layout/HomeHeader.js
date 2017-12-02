import React, { Component } from 'react';
import { Menu, Icon, Layout, Row, Col } from 'antd';
import './HomeHeader.less';
import { Link } from 'react-router-dom'

const { Header } = Layout;

class HomeHeader extends Component {
  state = {
    current: '',
  }

  handleClick = (e) => {
    this.setState({
      current: e.key,
    });
  }

  render() {
    return (
      <Header className="header">
        <Row>
          <Col xs={0} sm={4}>
            <div className="brand"><a href="/">Wang Jian IO</a></div>
          </Col>
          <Col>
            <Menu
              className="menu"
              onClick={this.handleClick}
              selectedKeys={[this.state.current]}
              mode="horizontal"
              theme="dark"
            >
              <Menu.Item key="home"><Link to="/index">主页</Link></Menu.Item>
              <Menu.Item key="blog"><Link to="/blog">文章</Link></Menu.Item>
              <Menu.SubMenu title={<span>项目<Icon type="down" /></span>}>
                <Menu.Item key="project:1"><Link to="/projects/oxford_dictionary">Oxford Dictionaries 英语发音</Link></Menu.Item>
                <Menu.Item key="project:2"><Link to="/projects/cet/jilin">吉林英语四六级准考证号查询</Link></Menu.Item>
                <Menu.Item key="project:3"><Link to="/projects/workflow">Workflow</Link></Menu.Item>
                <Menu.Divider />
                <Menu.Item key="project:4"><Link to="/projects/null">文件管理系统 (Beta)</Link></Menu.Item>
                <Menu.Item key="project:5"><Link to="/projects/12306">12306 信息处理 (Beta)</Link></Menu.Item>
                <Menu.Item key="project:6"><Link to="/projects/money">Money - 个人财务管理 (Beta)</Link></Menu.Item>
              </Menu.SubMenu>
              <Menu.SubMenu title={<span>工具<Icon type="down" /></span>}>
                <Menu.Item key="tool:1"><Link to="/tools/ip">IP</Link></Menu.Item>
                <Menu.Item key="tool:2"><Link to="/tools/md5">MD5</Link></Menu.Item>
                <Menu.Item key="tool:3"><Link to="/tools/time">Time</Link></Menu.Item>
                <Menu.Item key="tool:4"><Link to="/tools/ua">User Agent</Link></Menu.Item>
              </Menu.SubMenu>
              <Menu.Item key="about"><Link to="/about">关于</Link></Menu.Item>
            </Menu>
          </Col>
        </Row>
      </Header>
    )
  }
}

export default HomeHeader;
