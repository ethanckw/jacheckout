import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import Main from './main';
import Order from './order';
import OrderPurchase from './orderPurchase';

ReactDOM.render(
  <Router>
    <Route exact path="/" component={Main} />
    <Route path="/order/:id" component={OrderPurchase} />
    <Route exact path="/order" component={Order} />
  </Router>
  ,document.getElementById('root')
);
