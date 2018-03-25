import React, { Component } from 'react';
import { Button, Row } from 'antd';

import './NotFound.less';

class NotFound extends Component {
  constructor() {
    super();
    this.state = {
      showBackButton: false
    }
  }

  componentWillMount() {
    if (window.location.pathname !== '/404') {
      window.location.href = '/404';
    }

    if (window.history.length > 1) {
      this.setState({
        showBackButton: true
      })
    }
  }

  componentDidMount() {
    const width = window.screen.width * window.devicePixelRatio;
    const height = window.screen.height * window.devicePixelRatio;

    const elem = document.querySelector('.ant-layout');
    elem.classList.add('not-found-bg');
    elem.style.backgroundImage = `url(https://source.unsplash.com/random/${width}x${height})`

    document.querySelector('.footer').style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
  }

  componentWillUnmount() {
    const elem = document.querySelector('.ant-layout');
    elem.classList.remove('not-found-bg');
    elem.style.backgroundImage = '';

    document.querySelector('.footer').removeAttribute('style');
  }

  historyBack = (e) => {
    e.preventDefault();
    window.history.back();
  }

  render() {
    return (
      <Row className="not-found">
        <h1>404 - 没有找到页面</h1>
        {this.state.showBackButton && <Button icon="rollback" ghost type="" onClick={this.historyBack} style={{ marginBottom: 12 }}>返回上一页</Button>}
        {this.state.showBackButton && <br />}
        <Button icon="home" ghost href="/">回到主页</Button>
      </Row>
    )
  }

}

export default NotFound;