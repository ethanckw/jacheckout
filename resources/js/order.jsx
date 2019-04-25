import React, { Component } from 'react';
import { Redirect } from "react-router-dom";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import NavHeader from './navheader';


class Order extends Component {

  constructor(props) {
    super(props);

    this.state = {
      customers: [],
      selectedCustomer: 0,
      redirectUrl: '',
    }

    this.createOrder = this.createOrder.bind(this)
    this.selectCustomer = this.selectCustomer.bind(this)
  }
  componentDidMount() {
    window.fetch('api/customers')
          .then(response => response.json())
          .then(data => {
            this.setState({customers: data});
          })
  }

  createOrder() {
    const url = `api/order/${this.state.selectedCustomer}`;

    window.fetch(url, {method: 'POST'})
      .then(response => response.json())
      .then(data => {
        this.setState({redirectUrl: `/order/${data.id}`})
      })
  }

  selectCustomer(event) {
    this.setState({selectedCustomer: event.target.value})
  }

  render() {
    return (
      <Container fluid className="px-0">
        <NavHeader/>
        <Container>
          {this.state.redirectUrl.length > 0 && <Redirect to={this.state.redirectUrl}/>}
          <Form className="my-5">
            <Form.Group controlId="orderForm.CustomerSelect">
              <Form.Label>Customer</Form.Label>
                <Form.Control
                  size="lg"
                  as="select"
                  onChange={this.selectCustomer}
                  defaultValue={this.state.selectedCustomer}
                >
                  {this.state.customers.map(customer =>
                    <option key={`customer-${customer.id}`} value={customer.id}>{customer.name}</option>
                  )}
                </Form.Control>
                <Form.Row className="my-3">
                  <Col>
                    <Button size="lg" onClick={this.createOrder} variant="success" disabled={this.state.selectedCustomer == 0}>Start</Button>
                  </Col>
                </Form.Row>
            </Form.Group>
          </Form>
        </Container>
      </Container>
    );
  }
}

export default Order;
