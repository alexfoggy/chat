import React, { useState, useEffect } from 'react'
import { useForm, Controller } from "react-hook-form";
import { getUser, profileUpdate } from '../../../../api/api'
import '../../../../../../public/css/components/block.css'
import '../../../../../../public/css/components/form.css'
import { Button, Snackbar } from "@material-ui/core";
import PhoneInput from 'react-phone-input-2'
import 'react-phone-input-2/lib/style.css'
import { Alert, } from '@material-ui/lab';
import { Collapse, CardBody, Card, Input } from 'reactstrap';
import './radioButton.css'
import SelectContainer from './Select/SelectContainer'
import { Tooltip } from 'react-tippy';
import SelectOption from './Select/Select';


import { Select } from 'antd';
import 'antd/dist/antd.css';


const styles = {
    input: {
        transition: ".3s ease",
        fontWeight: 'bold',
        padding: '5px 15px',
        width: '300px'
    },
    select: {
        padding: '5px 10px',
        width: '100%',
        border: '1px solid rgba(100, 100, 100, 0.15)',
        borderRadius: '5px',
    },
    label: {
        fontWeight: 'bold',
        fontSize: '22px'
    },
    edit: {
        margin: '0',
        background: ' rgb(226, 42, 127)',
        color: 'white',
        marginLeft: '15px'
    },

    button: {
        display: 'flex',
        justifyContent: 'flex-start',
        marginTop: '50px'
    },
    title: {
        fontWeight: 'bold',
        color: '#d11267',
    },
    language: {
        marginRight: '20px',
        border: '1px solid #dbd0d0',
        padding: ' 20px 23px',
        borderRadius: ' 5px'
    },
    buttonLannguage: {
        marginBottom: '1rem',
        background: '#E22A7F',
        color: 'white',
        padding: '10px 30px',
        borderRadius: '5px',
    },
}



const { Option } = Select;
const provinceData = ["Russian", "English"];
const cityData = {
    Russian: ["1", "2", "3"],
    English: ["4", "5", "6"]
};

const ReactHookForm = (props) => {
    console.log(props.user.languages)
       
    const [status, setStatus] = useState(false)
    const [email, setEmail] = useState(false)
    const [payPal, setpayPal] = useState(false)
    const [language, setLanguage] = useState(false)
    const [phoneNumber, setPhoneNumber] = useState(false)
    const [open, setOpen] = useState(false);
    const handleClick = () => {
        setOpen(true);

    };
    const [cities, setCities] = useState(cityData[provinceData[1]]);
    const [secondCity, setSecondCity] = useState(
        cityData[provinceData[0]][0]
    );

    const handleProvinceChange = value => {
        setCities(cityData[value]);
        setSecondCity(cityData[value][0]);
    };

    const onSecondCityChange = value => {
        setSecondCity(value);
    };

    const handleClose = (event, reason) => {
        setOpen(false);
    }
    const { register, handleSubmit, watch, errors, control } = useForm({
    });
    const onSubmit = ({ email, phone, gender, main_language, main_level, birth_date, paypal, country, second_language, second_country, second_level }) => {
        setStatus(true)
        profileUpdate(email, phone, gender, main_language, main_level, birth_date, paypal, country, second_language, second_country, second_level)
            .then(res => {
                console.log(res)
            })
    }
    // const onSubmit = data => console.log(data)
    const changeEmail = () => {
        setEmail(true)
    }
    const changePhoneNumber = () => {
        setPhoneNumber(true)
    }
    const changeLanguage = () => {
        setLanguage(true)
    }
    const changePayPal = () => {
        setpayPal(true)
    }
    const [secondLanguage, setSecondLannguage] = useState(false);
    const toggle = () => setSecondLannguage(!secondLanguage);

    const [mainLanguage, setMainLanguage] = useState(false);
    const toggleM = () => setMainLanguage(!mainLanguage);

    useEffect(() => {
        props.user.main_language !== '' ? setMainLanguage(false) : setMainLanguage(true)

    }, [])

    const defaultLanguages = () => {
        const a = props.user.main_language
        console.log(a)
        if (a) {
            return true;
        }
        return false;
    }

    const phone = props.user.phone
    const { Option, OptGroup } = Select;

setTimeout(()=>{
     
    console.log(props.user.languages.name)

   
},4000)
    return (<>

        {/* <Select showSearch value={props.user.main_language} style={{ width: 200 }}>
            {props.languages.map((item, idx) => (
                <Option key={idx} value={item.name}>
                    {item.name}
                </Option>
            ))}

        </Select> */}
       
        <h2 style={{
            fontWeight: 'bold',
            color: '#d11267',
            padding: '30px',
            margin: 0
        }}>Basic Information</h2>

        <div className="block">
            <div className="block-content">
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="row">
                        <div className="col-7">
                            <div className="form-group">
                                <label style={styles.label} htmlFor="email">Email</label>
                                <div className="d-flex align-items-center">
                                    {!email ?
                                        <Tooltip
                                            className='pop'
                                            trigger="mouseenter"
                                            title="If you want to change email click Edit"
                                            position="bottom"
                                            animation="scale"
                                        >
                                            <input name="email" style={styles.input} ref={register} defaultValue={props.user.email} disabled />
                                        </Tooltip>
                                        : <input name="email" style={styles.input} ref={register} defaultValue={props.user.email} />
                                    }
                                    {
                                        !email
                                            ? <Button style={styles.edit} color="secondary" onClick={changeEmail}> <i className="flaticon-edit"></i></Button>
                                            : <Button disabled color="secondary" onClick={changeEmail}> <i className="flaticon-edit"></i> </Button>
                                    }
                                </div>
                            </div>

                        </div>
                        <div className="col-7">
                            <div className="form-group">
                                <label style={styles.label} htmlFor="birth_date">Birthday</label>
                                <input style={styles.input} defaultValue={props.user.birth_date} type="date" ref={register} name="birth_date" />

                            </div>
                        </div>
                        <div className="col-7">
                            <div className="form-group">
                                <label style={styles.label} htmlFor="gender">Gender</label>
                                <div>
                                    {props.user.gender === 'Male'
                                        ?
                                        <div>
                                            <div className="form_radio_btn">
                                                <input id="gendor-1" type="radio" ref={register} name="gender" value="Male" defaultChecked />
                                                <label htmlFor="gendor-1">Male</label>
                                            </div>
                                            <div className="form_radio_btn">
                                                <input id="gendor-2" type="radio" ref={register} name="gender" value="Female" />
                                                <label htmlFor="gendor-2">Female</label>
                                            </div>
                                        </div>

                                        : <div>
                                            <div className="form_radio_btn">
                                                <input id="gendor-1" type="radio" ref={register} name="gender" value="Male" />
                                                <label htmlFor="gendor-1">Male</label>
                                            </div>
                                            <div className="form_radio_btn">
                                                <input id="gendor-2" type="radio" ref={register} name="gender" value="Female" defaultChecked />
                                                <label htmlFor="gendor-2">Female</label>
                                            </div>
                                        </div>
                                    }
                                </div>
                            </div>
                        </div>
                        <div className="col-7">
                            <label style={styles.label} htmlFor="phone_number">Phone Number</label>
                            <div className="form-group">
                                <div className="d-flex align-items-center" style={{ width: '380px' }}>
                                    {!phoneNumber ? <Tooltip
                                        className='pop'
                                        trigger="mouseenter"
                                        title="If you want to change email phone number Edit"
                                        position="bottom"
                                        animation="scale"
                                    >
                                        {/* <h1>PhoneNumber</h1> */}
                                        <Controller
                                            as={PhoneInput}
                                            name="phone"
                                            control={control}
                                            placeholder={phone ? phone : 'Type your phone here'}
                                            // country={'us'}
                                            disabled
                                        />  </Tooltip>
                                        : <Controller
                                            as={PhoneInput}
                                            name="phone"
                                            control={control}
                                            defaultValue={phone}
                                        // country={'us'}
                                        />
                                    }

                                    {!phoneNumber
                                        ?
                                        <Button style={styles.edit} color="secondary" onClick={changePhoneNumber} ><i className="flaticon-edit"></i></Button>
                                        : <Button disabled color="secondary" onClick={changePhoneNumber} ><i className="flaticon-edit"></i></Button>}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <h2 style={styles.title} className="col-12">Language Abilities</h2>
                        <div className="col-12">
                            <div className="line in-row"></div>
                        </div>

                        <div className="col-12">
                            <div style={{ margin: '40px 0' }}>
                                <Button onClick={toggleM} style={styles.buttonLannguage}> +Add  language</Button>
                                <Collapse isOpen={mainLanguage}>
                                    <Card>
                                        <CardBody>
                                            <div className="row">
                                                <div className="col-5">
                                                    <div className="form-group">
                                                        <label htmlFor="main_language">Language</label>
                                                        {/* <Select
                                                        ref={register}
                                                        name="main_language"
                                                            // value={props.user.main_language }
                                                            showSearch
                                                            style={{ width: '100%' }}
                                                        placeholder={props.user.main_language}
                                                        >

                                                            {props.languages.map((item, idx) => (
                                                                <Select.Option key={idx} value={item.name}>
                                                                    {item.name}
                                                                </Select.Option>
                                                            ))}
                                                        </Select> */}
                                                        <>
                                                            <Controller
                                                                control={control}
                                                                name="main_language"
                                                                as={
                                                                    <Select
                                                                        defaultValue={props.user.main_language}
                                                                        placeholder={props.user.main_language}

                                                                        showSearch
                                                                        style={{ width: '100%' }}
                                                                    >

                                                                        {props.languages.map((item, idx) => (
                                                                            <Select.Option key={idx} value={item.name}>
                                                                                {item.name}
                                                                            </Select.Option>
                                                                        ))}
                                                                    </Select>
                                                                }
                                                            />
                                                        </>
                                                    </div>
                                                </div>
                                                <div className="col-5">
                                                    <div className="form-group">
                                                        <label htmlFor="country">Country </label>
                                                        <>
                                                            <Controller
                                                                control={control}
                                                                name="country"
                                                                as={
                                                                    <Select
                                                                        showSearch
                                                                        style={{ width: '100%' }}
                                                                        defaultValue={props.user.country}
                                                                        placeholder={props.user.country}
                                                                    >
                                                                        {props.countries.map((item, idx) => (
                                                                            <Select.Option key={idx} value={item.name}>
                                                                                {item.name}
                                                                            </Select.Option>
                                                                        ))}
                                                                    </Select>
                                                                }
                                                            />
                                                        </>
                                                    </div>
                                                </div>
                                                <div>
                                                    {(() => {
                                                        switch (props.user.level) {
                                                            case "Basic":
                                                                return (
                                                                    <div className="col-12">
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-1" type="radio" ref={register} name="main_level" value="0" defaultChecked />
                                                                            <label htmlFor="main_language-1">Basic</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-2" type="radio" ref={register} name="main_level" value="1" />
                                                                            <label htmlFor="main_language-2">Intermediate</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-3" type="radio" ref={register} name="main_level" value="2" />
                                                                            <label htmlFor="main_language-3">Fluent</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-4" type="radio" ref={register} name="main_level" value="3" />
                                                                            <label htmlFor="main_language-4">Native</label>
                                                                        </div>

                                                                    </div>
                                                                )
                                                            case "Intermediate":
                                                                return (
                                                                    <div className="col-12">
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-1" type="radio" ref={register} name="main_level" value="0" />
                                                                            <label htmlFor="main_language-1">Basic</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-2" type="radio" ref={register} name="main_level" value="1" defaultChecked />
                                                                            <label htmlFor="main_language-2">Intermediate</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-3" type="radio" ref={register} name="main_level" value="2" />
                                                                            <label htmlFor="main_language-3">Fluent</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-4" type="radio" ref={register} name="main_level" value="3" />
                                                                            <label htmlFor="main_language-4">Native</label>
                                                                        </div>

                                                                    </div>
                                                                )
                                                            case "Fluent":
                                                                return (
                                                                    <div className="col-12">
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-1" type="radio" ref={register} name="main_level" value="0" />
                                                                            <label htmlFor="main_language-1">Basic</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-2" type="radio" ref={register} name="main_level" value="1" />
                                                                            <label htmlFor="main_language-2">Intermediate</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-3" type="radio" ref={register} name="main_level" value="2" defaultChecked />
                                                                            <label htmlFor="main_language-3">Fluent</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-4" type="radio" ref={register} name="main_level" value="3" />
                                                                            <label htmlFor="main_language-4">Native</label>
                                                                        </div>

                                                                    </div>
                                                                )
                                                            case "Native":
                                                                return (
                                                                    <div className="col-12">
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-1" type="radio" ref={register} name="main_level" value="0" />
                                                                            <label htmlFor="main_language-1">Basic</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-2" type="radio" ref={register} name="main_level" value="1" />
                                                                            <label htmlFor="main_language-2">Intermediate</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-3" type="radio" ref={register} name="main_level" value="2" />
                                                                            <label htmlFor="main_language-3">Fluent</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-4" type="radio" ref={register} name="main_level" value="3" defaultChecked />
                                                                            <label htmlFor="main_language-4">Native</label>
                                                                        </div>

                                                                    </div>
                                                                )
                                                            default:
                                                                return (
                                                                    <div className="col-12">
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-1" type="radio" ref={register} name="main_level" value="0" />
                                                                            <label htmlFor="main_language-1">Basic</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-2" type="radio" ref={register} name="main_level" value="1" />
                                                                            <label htmlFor="main_language-2">Intermediate</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-3" type="radio" ref={register} name="main_level" value="2" />
                                                                            <label htmlFor="main_language-3">Fluent</label>
                                                                        </div>
                                                                        <div className="form_radio_btn">
                                                                            <input id="main_language-4" type="radio" ref={register} name="main_level" value="3" />
                                                                            <label htmlFor="main_language-4">Native</label>
                                                                        </div>

                                                                    </div>
                                                                )

                                                        }
                                                    })()}
                                                </div>
                                            </div>
                                        </CardBody>
                                    </Card>
                                </Collapse>
                            </div>
                            <div style={{ margin: '40px 0' }}>
                                <Button onClick={toggle} style={styles.buttonLannguage}> +Add another language</Button>
                                <Collapse isOpen={secondLanguage}>
                                    <Card>
                                        <CardBody>
                                            <div className="row">
                                                <div className="col-5">
                                                    <div className="form-group">
                                                        <label htmlFor="second_language">Language</label>
                                                        <>
                                                            <Controller
                                                                control={control}
                                                                name="second_language"
                                                                as={
                                                                    <Select
                                                                        showSearch
                                                                        style={{ width: '100%' }}
                                                                    // placeholder={props.user.languages.name == undefined? '': props.user.languages.name}
                                                                    >
                                                                        {props.languages.map((item, idx) => (
                                                                            <Select.Option key={idx} value={item.name}>
                                                                                {item.name}
                                                                            </Select.Option>
                                                                        ))}
                                                                    </Select>
                                                                }
                                                            />
                                                        </>
                                                    </div>
                                                </div>
                                                <div className="col-5">
                                                    <div className="form-group">
                                                        <label htmlFor="second_country">Country</label>

                                                        <>
                                                            <Controller
                                                                control={control}
                                                                name="second_country"
                                                                as={
                                                                    <Select
                                                                        showSearch
                                                                        style={{ width: '100%' }}
                                                                    // placeholder={props.user.country}
                                                                    >
                                                                        {props.countries.map((item, idx) => (
                                                                            <Select.Option key={idx} value={item.name}>
                                                                                {item.name}
                                                                            </Select.Option>
                                                                        ))}
                                                                    </Select>
                                                                }
                                                            />
                                                        </>

                                                    </div>
                                                </div>
                                                <div>
                                                    <div className="col-12">
                                                        <div className="form_radio_btn">
                                                            <input id="second_language-1" type="radio" ref={register} name="second_level" value="0" />
                                                            <label htmlFor="second_language-1">Basic</label>
                                                        </div>
                                                        <div className="form_radio_btn">
                                                            <input id="second_language-2" type="radio" ref={register} name="second_level" value="1" />
                                                            <label htmlFor="second_language-2">Intermediate</label>
                                                        </div>
                                                        <div className="form_radio_btn">
                                                            <input id="second_language-3" type="radio" ref={register} name="second_level" value="2" />
                                                            <label htmlFor="second_language-3">Fluent</label>
                                                        </div>
                                                        <div className="form_radio_btn">
                                                            <input id="second_language-4" type="radio" ref={register} name="second_level" value="3" />
                                                            <label htmlFor="second_language-4">Native</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </CardBody>
                                    </Card>
                                </Collapse>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <h2 style={styles.title} className="col-12">Payment Information</h2>
                        <div className="col-12">
                            <div className="line in-row"></div>
                        </div>
                        <div className="col-7">
                            <div className="form-group">
                                <div className="d-flex align-items-center">
                                    {!payPal ?
                                        <Tooltip
                                            className='pop'
                                            trigger="mouseenter"
                                            title="If you want to change email click Edit"
                                            position="bottom"
                                            animation="scale"
                                        >
                                            <input name="paypal" style={styles.input} ref={register} defaultValue={props.user.email} disabled />
                                        </Tooltip>
                                        : < input name="paypal" style={styles.input} ref={register} defaultValue={props.user.email} />
                                    }
                                    {!payPal
                                        ? <Button style={styles.edit} color="secondary" onClick={changePayPal}> <i className="flaticon-edit"></i></Button>
                                        : <Button disabled color="secondary" onClick={changePayPal}> <i className="flaticon-edit"></i> </Button>
                                    }
                                </div>
                            </div>
                        </div>
                        <div className="col-12">
                            <div style={styles.button}>
                                {status ? <Button disabled variant="contained" color="secondary" type="submit">Save profile</Button> :
                                    <Button style={styles.buttonLannguage} variant="contained" onClick={handleClick} color="secondary" type="submit">Save profile</Button>}
                            </div>
                        </div>
                    </div>
                </form>
                <Snackbar open={open} autoHideDuration={6000} onClose={handleClose}>
                    <Alert onClose={handleClose} severity="success">
                        Your profile was updated
                        </Alert>
                </Snackbar>
            </div>
        </div >
    </>)
}
export default ReactHookForm
