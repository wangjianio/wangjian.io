import React, { Component } from 'react';
import './PageTitle.less';

class PageTitle extends Component {
  // constructor(props) {
  //   super(props);
  // }

  render() {
    const { title } = this.props;
    return (
      <h1>{title}</h1>
    )
  }
}

export default PageTitle;