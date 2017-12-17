import React, { Component } from 'react';

class Counter extends Component {
  render() {
    const result = this.props.value ? 'True' : 'False';
    return (
      <div>
        <button onClick={() => this.props.onBtnClick(this.props.value)}>button</button>
        <p>{result}使用sdasdas。</p>
      </div>
    )
  }
}

export default Counter;