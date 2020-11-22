import React from 'react';
import { Card } from 'antd';
import './ArticleCard.less';

export default class extends React.Component {

  componentWillMount() {
    this.onWindowResize();
    window.addEventListener('resize', this.onWindowResize);
  }

  componentWillUnmount() {
    window.removeEventListener('resize', this.onWindowResize);
  }

  onWindowResize = () => {
    this.setState({
      sm: window.document.body.clientWidth < 768
    });
  }

  render() {
    const { sm } = this.state;

    return <Card
      className="post-card"
      style={{ padding: sm ? 0 : 24, cursor: 'auto' }}
      bordered={!sm}
      hoverable={!sm}
    >
      {this.props.children}
    </Card>
  }
}