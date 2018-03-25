import React from 'react';
import PageTitle from '../components/PageTitle';
import ArticleCard from '../components/ArticleCard';
import './Post.less';

export default class extends React.Component {
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
      <React.Fragment>
        <PageTitle title={this.state.title} updateTime={this.state.editDate} />
        <ArticleCard>
          <div className="markdown-body" dangerouslySetInnerHTML={{ __html: this.state.content }} />
        </ArticleCard>
      </React.Fragment>
    )
  }
}
