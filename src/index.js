import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import './assets/primer-markdown-formated.css';
import registerServiceWorker from './utils/registerServiceWorker';

ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
