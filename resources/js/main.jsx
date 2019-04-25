import React, { Component } from 'react';
import { Link } from "react-router-dom";
import Table from 'react-bootstrap/Table';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import ButtonToolbar from 'react-bootstrap/ButtonToolbar';
import Button from 'react-bootstrap/Button';
import NavHeader from './navheader';


class Main extends Component {

  constructor(props) {
    super(props);

    this.state = {
      orders: []
    }
  }

  componentDidMount() {
    window.fetch('api/orders')
          .then(response => response.json())
          .then(data => {
            this.setState({orders: data});
          })
  }

  render() {
    return (
      <Container fluid className="px-0">
        <NavHeader/>
        <Container>
          <Row className="my-5">
            <Col>
              <ButtonToolbar>
                <Link to='/order'><Button variant="primary">New Order</Button></Link>
              </ButtonToolbar>
            </Col>
          </Row>
          <Row>
            <Table striped bordered hover>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Gross Price</th>
                  <th>Net Price</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                </tr>
              </thead>
              <tbody>
                {this.state.orders.map(order =>
                  <tr key={`order-${order.id}`}>
                    <td><Link to={`/order/${order.id}`}>{order.id}</Link></td>
                    <td>{order.customer}</td>
                    <td>{order.status}</td>
                    <td>{order.gross_price}</td>
                    <td>{order.net_price}</td>
                    <td>{order.created_at}</td>
                    <td>{order.updated_at}</td>
                  </tr>
                )}
              </tbody>
            </Table>
          </Row>
        </Container>
      </Container>
    );
  }
}

export default Main;
