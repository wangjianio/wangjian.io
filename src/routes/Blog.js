import React, { Component } from 'react';
import PageTitle from '../components/PageTitle';
import BlogListItem from '../components/BlogListItem';

class Blog extends Component {
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

    fetch('https://wangjian.io/api/blog/post', config).then(
      response => response.json(),
    ).then(
      json => this.renderBlogList(json),
    )
  }

  renderBlogList = data => {
    const blogList = data.map(
      item => <BlogListItem key={item.id} postId={item.id} postTitle={item.title} postPubDate={item.pubDate} />,
    );

    this.setState({
      blogList: blogList
    })
  }

  render() {
    return (
      <React.Fragment>
        <PageTitle title='文章列表' />
        {this.state.blogList}
      </React.Fragment>
    )
  }
}

export default Blog;
