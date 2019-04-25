import React, { Component } from 'react';
import { Link } from "react-router-dom";
import Navbar from 'react-bootstrap/Navbar';

class NavHeader extends Component {
  render() {

    return (
      <Navbar bg="light" expand="lg" className="mx-0">
        <Navbar.Brand>
          <Link to='/'>Home</Link>
        </Navbar.Brand>
      </Navbar>
    );
  }
}

export default NavHeader;
