import React, { Component } from 'react';
import { Redirect } from "react-router-dom";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import ButtonGroup from 'react-bootstrap/ButtonGroup';
import Button from 'react-bootstrap/Button';
import Table from 'react-bootstrap/Table';
import Card from 'react-bootstrap/Card';
import Badge from 'react-bootstrap/Badge';


class OrderPurchase extends Component {
  constructor(props) {
    super(props);

    this.state = {
      order: {
        customer: {
          name: ''
        },
        order_items: []
      },
      ads: [],
    }

    this.addItem = this.addItem.bind(this)
    this.add = this.add.bind(this)
    this.remove = this.remove.bind(this)
    this.loadOrder = this.loadOrder.bind(this)
  }

  loadOrder() {
    window.fetch(`/api/order/${this.props.match.params.id}`)
          .then(response => response.json())
          .then(data => {
            this.setState({order: data});
          })
  }

  componentDidMount() {
    this.loadOrder();

    window.fetch('/api/ads')
          .then(response => response.json())
          .then(data => {
            this.setState({ads: data});
          })
  }

  addItem(event) {
    const adId = event.target.value
    const url = `/api/order/${this.props.match.params.id}/ad/${adId}`

    window.fetch(url, {method:'POST'})
          .then(() => {
            this.loadOrder()
          })
  }

  add(event) {
    const orderItemId = event.target.value
    const url = `/api/orderItem/${orderItemId}/add`

    window.fetch(url, {method:'POST'})
          .then(() => {
            this.loadOrder()
          })
  }

  remove(event) {
    const orderItemId = event.target.value
    const url = `/api/orderItem/${orderItemId}/remove`

    window.fetch(url, {method:'POST'})
          .then(() => {
            this.loadOrder()
          })
  }

  render() {
    const {
      order,
      ads,
    } = this.state

    return (
      <Container>
        <Row>
          <h1>{order.customer.name}</h1>
        </Row>
        <Row>
          <Col>
            <h2>
              {`Order ID: ${order.id}`}
              <Badge variant="secondary">{order.status}</Badge>
            </h2>
          </Col>
          <Col>
            <h2>{`Total: ${order.net_price}`}</h2>
          </Col>
        </Row>
        <Row>
          {ads.filter(ad =>
            !this.state.order.order_items.find(
              item => ad.id == item.ad_type_id
            )
            ).map((ad, idx) =>
              <Col key={`ad-${idx}`}>
                <Card>
                  <Card.Body>
                    <Card.Title>{ad.name}</Card.Title>
                    <Card.Text>{ad.description}</Card.Text>
                    <Button onClick={this.addItem} variant="primary" value={ad.id}>Add</Button>
                  </Card.Body>
                </Card>
              </Col>
          )}
        </Row>
        <Row>
          <Table striped bordered hover>
            <thead>
              <tr>
                <th>Ad</th>
                <th>Quantity</th>
                <th>Gross Price</th>
                <th>Net Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {order.order_items.map(item =>
                <tr key={`item-${item.id}`}>
                  <td>{item.ad_type ? item.ad_type.name : ''}</td>
                  <td>{item.quantity}</td>
                  <td>{item.gross_price}</td>
                  <td>{item.net_price}</td>
                  <td>
                    <ButtonGroup>
                      <Button onClick={this.add} value={item.id} variant="success">Add</Button>
                      <Button onClick={this.remove} value={item.id}  variant="danger">Remove</Button>
                    </ButtonGroup>
                  </td>
                </tr>
              )}
            </tbody>
          </Table>
        </Row>
      </Container>
    );
  }
}

export default OrderPurchase;
