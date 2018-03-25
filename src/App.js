import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';

import { AppContext, AppProvider } from './context/App';

import { LocaleProvider, Layout, Row, Col } from 'antd';
import moment from 'moment';
import 'moment/locale/zh-cn';
import zhCN from 'antd/lib/locale-provider/zh_CN';

import Header from './components/Layout/Header';
import Footer from './components/Layout/Footer';
import About from './routes/About';
import Home from './routes/Home';
import Blog from './routes/Blog';
import Post from './routes/Post';
import Ip from './routes/tools/Ip';
import Md5 from './routes/tools/Md5';
import Time from './routes/tools/Time';
import UserAgent from './routes/tools/UserAgent';
// import Money from './routes/projects/Money';
import CetJilin from './routes/projects/CetJilin';
import OxfordDictionary from './routes/projects/OxfordDictionary';
import Workflow from './routes/projects/Workflow';
import Railway12306 from './routes/projects/Railway12306';
import NotFound from './routes/NotFound';

import './App.less';

moment.locale('zh-cn');

class App extends React.Component {
  render() {
    return (
      <LocaleProvider locale={zhCN}>
        <BrowserRouter>
          <AppProvider>
            <AppContext.Consumer>
              {context => (
                <Layout style={{ height: '100vh', background: 'none' }}>
                  <Header />
                  <Layout.Content style={{ padding: '24px 0' }}>
                    <Row type="flex" justify="center">
                      <Col xs={22} md={20} lg={18}>

                        <Switch>
                          <Route path="/" exact component={Home} />
                          <Route path="/blog" exact component={Blog} />
                          <Route path="/blog/post/:id" component={Post} />
                          <Route path="/about" component={About} />
                          <Route path="/tools/ip" component={Ip} />
                          <Route path="/tools/time" component={Time} />
                          <Route path="/tools/ua" component={UserAgent} />
                          <Route path="/tools/md5" component={Md5} />
                          <Route path="/projects/cet/jilin" component={CetJilin} />
                          <Route path="/projects/oxford_dictionary" component={OxfordDictionary} />
                          <Route path="/projects/railway12306" component={Railway12306} />
                          <Route path="/projects/workflow" component={Workflow} />
                          <Route component={NotFound} />
                          {/* <Route path="/projects/money" exact component={Money} />
              <Route path="/projects/money/:sub" component={Money} /> */}
                        </Switch>

                      </Col>
                    </Row>
                  </Layout.Content>
                  <Footer />
                </Layout>



              )}
            </AppContext.Consumer>
          </AppProvider>
        </BrowserRouter>
      </LocaleProvider >
    );
  }
}

export default App;
