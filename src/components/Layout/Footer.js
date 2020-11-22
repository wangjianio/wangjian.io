import React from 'react';
import { Layout, Row, Col, Icon } from 'antd';
import './Footer.less';

class Footer extends React.Component {
  render() {
    return (
      <Layout.Footer className="footer">
        <Row type="flex" justify="center">
          <Col xs={22} md={20} lg={18}>
            <Col xs={24} sm={12}>
              <p className="heading" id="contact-info">联系方式</p>
              <ul>
                <li><Icon type="mail" /> <a href="mailto:contact@wangjian.io">contact@wangjian.io</a></li>
                <li><Icon type="twitter" /> <a href="https://twitter.com/lopedever" target="_blank" rel="noopener noreferrer">@lopedever</a></li>
                <li><Icon type="github" /> <a href="https://github.com/wangjianio" target="_blank" rel="noopener noreferrer">@wangjianio</a></li>
              </ul>
            </Col>
            <Col xs={24} sm={0}><hr /></Col>
            <Col xs={24} sm={12}>
              <p className="heading">wangjian.io</p>
              <ul>
                <li>Made by Wang Jian, and open sourced on <a href="https://github.com/wangjianio/wangjian.io" target="_blank" rel="noopener noreferrer">Github</a>.</li>
                <li><a className="beian" href="http://www.miibeian.gov.cn" target="_blank" rel="noopener noreferrer">蒙ICP备17002783号</a></li>
              </ul>
            </Col>
          </Col>
        </Row>
      </Layout.Footer>
    )
  }
}

export default Footer;
