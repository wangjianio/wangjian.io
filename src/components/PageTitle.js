import React, { Component } from 'react';
import './PageTitle.less';

class PageTitle extends Component {
  render() {
    const { title, updateTime } = this.props;
    const style = {
      color: '#999',
      float: 'right',
      fontSize: '12px',
      fontWeight: 'normal',
      position: 'relative',
      top: 24,
    }
    return (
      <h1>{title}
        {updateTime ? <span style={style}>更新于：<time dateTime={updateTime}>{updateTime}</time></span> : null}
      </h1>
    )
  }
}

export default PageTitle;