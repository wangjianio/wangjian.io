import React from 'react';
import { Menu, Icon, Row, Col } from 'antd';
import { NavLink, Switch } from 'react-router-dom';
import { withRouter } from 'react-router';
import './Header.less';

class Header extends React.Component {

  render() {
    const { pathname } = this.props.location;

    const regexPost = new RegExp('^/blog/post/', 'i');
    const isPost = regexPost.test(pathname);

    const regexMoney = new RegExp('^/projects/money/', 'i');
    const isMoney = regexMoney.test(pathname);

    let selectedKeys = isPost ? '/blog' : pathname;
    selectedKeys = isMoney ? '/projects/money' : pathname;

    const MenuPost = (
      <Menu.Item key="/backToBlog">
        <NavLink to="/blog">返回文章列表</NavLink>
      </Menu.Item>
    )

    return (
      <header>
        <Row type="flex" justify="space-between">
          <Col>
            <Switch>
              <Menu
                className="menu"
                mode="horizontal"
                theme="dark"
                selectable={false}
              >
                <Menu.Item><a href="/">Wang Jian IO</a></Menu.Item>
                {isPost && MenuPost}
              </Menu>
            </Switch>
          </Col>
          <Col>
            <Switch>
              <Menu
                className="menu"
                selectedKeys={[selectedKeys]}
                mode="horizontal"
                theme="dark"
              >
                <Menu.Item key="/"><NavLink to="/">主页</NavLink></Menu.Item>
                <Menu.Item key="/blog"><NavLink to="/blog">文章</NavLink></Menu.Item>
                <Menu.SubMenu title={<span>项目<Icon type="down" /></span>}>
                  <Menu.Item key="/projects/oxford_dictionary"><NavLink to="/projects/oxford_dictionary" >Oxford Dictionaries 英语发音</NavLink></Menu.Item>
                  <Menu.Item key="/projects/cet/jilin"><NavLink to="/projects/cet/jilin">吉林英语四六级准考证号查询</NavLink></Menu.Item>
                  <Menu.Item key="/projects/workflow"><NavLink to="/projects/workflow">Workflow</NavLink></Menu.Item>
                  <Menu.Item key="/projects/railway12306"><NavLink to="/projects/railway12306">12306 信息处理</NavLink></Menu.Item>
                  <Menu.Divider />
                  <Menu.Item key="/projects/money"><NavLink to="/projects/money">Money - 个人财务管理 (Beta)</NavLink></Menu.Item>
                </Menu.SubMenu>
                <Menu.SubMenu title={<span>工具<Icon type="down" /></span>}>
                  <Menu.Item key="/tools/ip"><NavLink to="/tools/ip">IP</NavLink></Menu.Item>
                  <Menu.Item key="/tools/md5"><NavLink to="/tools/md5">MD5</NavLink></Menu.Item>
                  <Menu.Item key="/tools/time"><NavLink to="/tools/time">Time</NavLink></Menu.Item>
                  <Menu.Item key="/tools/ua"><NavLink to="/tools/ua">User Agent</NavLink></Menu.Item>
                </Menu.SubMenu>
                <Menu.Item key="/about"><NavLink to="/about">关于</NavLink></Menu.Item>
              </Menu>
            </Switch>
          </Col>
        </Row>
      </header>
    )
  }
}

export default withRouter(Header);
