import React, { Component } from 'react';
import { BrowserRouter, Route } from 'react-router-dom';
import { Layout, Col, Row } from 'antd';
import HomeHeader from './components/Layout/HomeHeader';
import UniFooter from './components/Layout/UniFooter';
import About from './routes/About';
import Home from './routes/Home';
import Blog from './routes/Blog';
import Ip from './routes/tools/Ip';
import Md5 from './routes/tools/Md5';
import Time from './routes/tools/Time';
import UserAgent from './routes/tools/UserAgent';
import Workflow from './routes/projects/Workflow';
import './App.less';

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
                <Route path="/index" component={Home} />
                <Route path="/blog" component={Blog} />
                <Route path="/about" component={About} />
                <Route path="/tools/ip" component={Ip} />
                <Route path="/tools/time" component={Time} />
                <Route path="/tools/ua" component={UserAgent} />
                <Route path="/tools/md5" component={Md5} />
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
