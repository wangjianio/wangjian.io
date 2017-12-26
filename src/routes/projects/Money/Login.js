import React, { Component } from 'react';
import { Row, Col } from 'antd';
import LoginForm from '../../../components/Money/LoginForm';
import './Login.less';

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
    }
  }

  render() {
    return (
      <Row className="money-login">
        <Col className="wrapper">
          <LoginForm />
        </Col >
      </Row >
    )
  }
}

export default Login;
