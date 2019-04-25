import React, { Component } from 'react';
import { Redirect } from "react-router-dom";
import Container from 'react-bootstrap/Container';
import Alert from 'react-bootstrap/Alert';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import ButtonGroup from 'react-bootstrap/ButtonGroup';
import Button from 'react-bootstrap/Button';
import Table from 'react-bootstrap/Table';
import CardDeck from 'react-bootstrap/CardDeck';
import Card from 'react-bootstrap/Card';
import Badge from 'react-bootstrap/Badge';
import NavHeader from './navheader';


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
      discounts: [],
    }

    this.addItem = this.addItem.bind(this)
    this.add = this.add.bind(this)
    this.remove = this.remove.bind(this)
    this.loadOrder = this.loadOrder.bind(this)
    this.loadAds = this.loadAds.bind(this)
  }

  loadOrder() {
    window.fetch(`/api/order/${this.props.match.params.id}`)
          .then(response => response.json())
          .then(data => {
            this.setState({order: data});
          })
          .then(() => {
            this.loadAds()
          })
  }

  loadAds() {
    window.fetch(`/api/ads/${this.state.order.customer.id}`)
          .then(response => response.json())
          .then(data => {
            this.setState({ads: data.ads, discounts: data.discounts});
          })
  }

  componentDidMount() {
    this.loadOrder();
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
      <Container fluid className="px-0">
        <NavHeader/>
        <Container>
          <Alert className="my-3" variant="info">
            <Alert.Heading>
              {order.customer.name}
              <Badge className="ml-2" variant="secondary">{order.status}</Badge>
            </Alert.Heading>
            <hr />
            <h4>{`Order ID: ${order.id}`}</h4>
            <h6>{`$${order.net_price}`}</h6>
          </Alert>

          <CardDeck>
            {ads.filter(ad =>
              !this.state.order.order_items.find(
                item => ad.id == item.ad_type_id
              )
              ).map((ad, idx) =>
                  <Card key={`ad-${idx}`}>
                    <Card.Body>
                      <Card.Title>{ad.name}</Card.Title>
                      <Card.Text>{ad.description}</Card.Text>
                      <Button onClick={this.addItem} variant="primary" value={ad.id}>Add</Button>
                    </Card.Body>
                    {this.state.discounts
                      .filter(discount => discount.ad_type_id == ad.id)
                      .map((discount, index) => {
                        const discountMessage = discount.offered_quantity
                          ? `Get a ${discount.offered_quantity} for ${discount.min_quantity} deal!`
                          : `Buy at ${discount.price_per_ad} when buying above ${discount.min_quantity} item(s)`

                        return <Card.Footer key={`discount-${index}`} className="bg-success text-white">
                          <Card.Title><h5>{discountMessage}</h5></Card.Title>
                        </Card.Footer>
                      })
                    }
                  </Card>
            )}
          </CardDeck>
          <Row className="my-3">
            <Col>
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
                        <Button size="lg" onClick={this.add} value={item.id} variant="success">+</Button>
                        <Button size="lg" onClick={this.remove} value={item.id}  variant="danger">-</Button>
                      </ButtonGroup>
                    </td>
                  </tr>
                )}
              </tbody>
            </Table>
            </Col>
          </Row>
        </Container>
      </Container>
    );
  }
}

export default OrderPurchase;
