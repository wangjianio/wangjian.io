import React, { Component } from 'react';
import { Row, Col, Card } from 'antd';
import PageTitle from '../components/PageTitle';

class Post extends Component {
  constructor(props) {
    super(props);
    this.state = {}
  }

  componentDidMount() {
    const config = {
      method: 'get',
      mode: 'cors',
      credentials: 'omit',
      headers: {
        // cache: 'reload'
        // 'Content-Type': 'text/plain',
      },
    };
    const apiUrl = 'https://wangjian.io/api/blog/post?id=' + this.props.match.params.id;
    fetch(apiUrl, config).then(
      response => response.json(),
    ).then(
      json => this.setState({
        title: json.title,
        editDate: json.editDate,
        content: json.content,
      }),
    )
  }

  render() {
    return (
      <Row>
        <Col>
          <PageTitle title={this.state.title} updateTime={this.state.editDate} />
          <Card>
            <div className="markdown-body" dangerouslySetInnerHTML={{ __html: this.state.content }} />
          </Card>
        </Col>
      </Row>
    )
  }
}

export default Post;
