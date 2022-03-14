import React from "react";
import "antd/dist/antd.css";
import { Select } from "antd";
import { Controller } from "react-hook-form";


class SelectUsers extends React.Component { 
    constructor(props) {
        super(props)
        this.state = {
            selectedItems: []
        }
    }

    handleChange = (selectedItems) => {
        this.setState({ selectedItems });
    };

    render() {
        const { selectedItems } = this.state;
        const filteredOptions = this.props.users.filter((o) => !selectedItems.includes(o));
        return (
            <>
                <Controller
                    control={this.props.control}
                    name="users"
                    as={
                        <Select
                            mode="multiple"
                            placeholder="Inserted are removed"
                            value={selectedItems}
                            onChange={this.handleChange}
                            style={{ width: "100%" }}
                        >
                            {filteredOptions.map((item) => (
                                <Select.Option key={item.id} value={item.first_name}>
                                    {item.first_name} {item.last_name}
                                </Select.Option>
                            ))}
                        </Select>
                    }
                />
            </>
        );
    }
}
export default SelectUsers
