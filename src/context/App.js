import React from 'react';

const AppContext = React.createContext();

class AppProvider extends React.Component {
  state = {
    headerType: 'default',
    footerType: 'default',
    contentBackgroundColor: 'none',
  }

  setContext(nextContext) {
    this.setState(nextContext);
  }


  render() {
    return (
      <AppContext.Provider
        value={{ ...this.state, setContext: this.setContext }}
      >
        {this.props.children}
      </AppContext.Provider>
    )
  }
}

class AppConsumer extends React.Component {
  render() {
    return (
      <AppContext.Consumer>
        {context => (
          this.props.children
        )}
      </AppContext.Consumer>
    )
  }
}

export {
  AppContext,
  AppProvider
}