import React, { Component } from 'react';
import { getLanguages } from '../../../../../api/api';
import SelectOption from './Select';

class SelectContainer extends Component {

  render() {
    return (
      <>
        <SelectOption
          main_Language={this.props.main_Language}
          {...this.props}
          languages={this.props.languages} />
      </>
    );
  }
}
export default SelectContainer