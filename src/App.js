import React, { Component } from 'react';
import { BrowserRouter, Route } from 'react-router-dom';
import { Layout, Col, Row } from 'antd';
import moment from 'moment';

import HomeHeader from './components/Layout/HomeHeader';
import UniFooter from './components/Layout/UniFooter';
import About from './routes/About';
import Home from './routes/Home';
import Blog from './routes/Blog';
import Post from './routes/Post';
import Ip from './routes/tools/Ip';
import Md5 from './routes/tools/Md5';
import Time from './routes/tools/Time';
import UserAgent from './routes/tools/UserAgent';
import Workflow from './routes/projects/Workflow';
import Railway12306 from './routes/projects/Railway12306';
import './App.less';

moment.locale('zh-cn');

const { Content } = Layout;

class App extends Component {

  render() {
    return (
      <BrowserRouter>
        <Layout className="layout" style={{ height: '100vh' }}>
          <HomeHeader />
          <Content style={{ padding: '24px 50px', background: '#fff' }}>
            <Row type="flex" justify="center">
              <Col xs={24} md={20} lg={18}>
                <Route path="/" exact component={Home} />
                <Route path="/blog" exact component={Blog} />
                <Route path="/blog/post/:id" component={Post} />
                <Route path="/about" component={About} />
                <Route path="/tools/ip" component={Ip} />
                <Route path="/tools/time" component={Time} />
                <Route path="/tools/ua" component={UserAgent} />
                <Route path="/tools/md5" component={Md5} />
                <Route path="/projects/railway12306" component={Railway12306} />
                <Route path="/projects/workflow" component={Workflow} />
              </Col>
            </Row>
          </Content>
          <UniFooter />
        </Layout>
      </BrowserRouter >

    );
  }
}

export default App;
