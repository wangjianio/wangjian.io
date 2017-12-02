import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './BlogListItem.less';


class BlogListItem extends Component {
  render() {
    const { postId, postPubDate, postTitle } = this.props;

    return (
      <li className="blog-list-item">
        <span className="post-pub-time">发布于：<time dateTime={postPubDate}>{postPubDate}</time></span>
        <span><Link to={'/blog/post/' + postId}>{postTitle}</Link></span>
      </li>
    );
  }
}

export default BlogListItem;
