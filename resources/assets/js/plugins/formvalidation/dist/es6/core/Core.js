import e from "./emitter";
import t from "./filter";
import i from "../filters/getFieldValue";
import s from "../validators/index";

class l {
    constructor(i, s) {
        this.elements = {};
        this.ee = e();
        this.filter = t();
        this.plugins = {};
        this.results = new Map;
        this.validators = {};
        this.form = i;
        this.fields = s
    }

    on(e, t) {
        this.ee.on(e, t);
        return this
    }

    off(e, t) {
        this.ee.off(e, t);
        return this
    }

    emit(e, ...t) {
        this.ee.emit(e, ...t);
        return this
    }

    registerPlugin(e, t) {
        if (this.plugins[e]) {
            throw new Error(`The plguin ${e} is registered`)
        }
        t.setCore(this);
        t.install();
        this.plugins[e] = t;
        return this
    }

    deregisterPlugin(e) {
        const t = this.plugins[e];
        if (t) {
            t.uninstall()
        }
        delete this.plugins[e];
        return this
    }

    registerValidator(e, t) {
        if (this.validators[e]) {
            throw new Error(`The validator ${e} is registered`)
        }
        this.validators[e] = t;
        return this
    }

    registerFilter(e, t) {
        this.filter.add(e, t);
        return this
    }

    deregisterFilter(e, t) {
        this.filter.remove(e, t);
        return this
    }

    executeFilter(e, t, i) {
        return this.filter.execute(e, t, i)
    }

    addField(e, t) {
        const i = Object.assign({}, {selector: "", validators: {}}, t);
        this.fields[e] = this.fields[e] ? {
            selector: i.selector || this.fields[e].selector,
            validators: Object.assign({}, this.fields[e].validators, i.validators)
        } : i;
        this.elements[e] = this.queryElements(e);
        this.emit("core.field.added", {elements: this.elements[e], field: e, options: this.fields[e]});
        return this
    }

    removeField(e) {
        if (!this.fields[e]) {
            throw new Error(`The field ${e} validators are not defined. Please ensure the field is added first`)
        }
        const t = this.elements[e];
        const i = this.fields[e];
        delete this.elements[e];
        delete this.fields[e];
        this.emit("core.field.removed", {elements: t, field: e, options: i});
        return this
    }

    validate() {
        this.emit("core.form.validating");
        return this.filter.execute("validate-pre", Promise.resolve(), []).then(() => Promise.all(Object.keys(this.fields).map(e => this.validateField(e))).then(e => {
            switch (true) {
                case e.indexOf("Invalid") !== -1:
                    this.emit("core.form.invalid");
                    return Promise.resolve("Invalid");
                case e.indexOf("NotValidated") !== -1:
                    this.emit("core.form.notvalidated");
                    return Promise.resolve("NotValidated");
                default:
                    this.emit("core.form.valid");
                    return Promise.resolve("Valid")
            }
        }))
    }

    validateField(e) {
        const t = this.results.get(e);
        if (t === "Valid" || t === "Invalid") {
            return Promise.resolve(t)
        }
        this.emit("core.field.validating", e);
        const i = this.elements[e];
        if (i.length === 0) {
            this.emit("core.field.valid", e);
            return Promise.resolve("Valid")
        }
        const s = i[0].getAttribute("type");
        if ("radio" === s || "checkbox" === s || i.length === 1) {
            return this.validateElement(e, i[0])
        } else {
            return Promise.all(i.map(t => this.validateElement(e, t))).then(t => {
                switch (true) {
                    case t.indexOf("Invalid") !== -1:
                        this.emit("core.field.invalid", e);
                        this.results.set(e, "Invalid");
                        return Promise.resolve("Invalid");
                    case t.indexOf("NotValidated") !== -1:
                        this.emit("core.field.notvalidated", e);
                        this.results.delete(e);
                        return Promise.resolve("NotValidated");
                    default:
                        this.emit("core.field.valid", e);
                        this.results.set(e, "Valid");
                        return Promise.resolve("Valid")
                }
            })
        }
    }

    validateElement(e, t) {
        this.results.delete(e);
        const i = this.elements[e];
        const s = this.filter.execute("element-ignored", false, [e, t, i]);
        if (s) {
            this.emit("core.element.ignored", {element: t, elements: i, field: e});
            return Promise.resolve("Ignored")
        }
        const l = this.fields[e].validators;
        this.emit("core.element.validating", {element: t, elements: i, field: e});
        const r = Object.keys(l).map(i => () => this.executeValidator(e, t, i, l[i]));
        return this.waterfall(r).then(s => {
            const l = s.indexOf("Invalid") === -1;
            this.emit("core.element.validated", {element: t, elements: i, field: e, valid: l});
            const r = t.getAttribute("type");
            if ("radio" === r || "checkbox" === r || i.length === 1) {
                this.emit(l ? "core.field.valid" : "core.field.invalid", e)
            }
            return Promise.resolve(l ? "Valid" : "Invalid")
        }).catch(s => {
            this.emit("core.element.notvalidated", {element: t, elements: i, field: e});
            return Promise.resolve(s)
        })
    }

    executeValidator(e, t, i, s) {
        const l = this.elements[e];
        const r = this.filter.execute("validator-name", i, [i, e]);
        s.message = this.filter.execute("validator-message", s.message, [this.locale, e, r]);
        if (!this.validators[r] || s.enabled === false) {
            this.emit("core.validator.validated", {
                element: t,
                elements: l,
                field: e,
                result: this.normalizeResult(e, r, {valid: true}),
                validator: r
            });
            return Promise.resolve("Valid")
        }
        const a = this.validators[r];
        const d = this.getElementValue(e, t, r);
        const o = this.filter.execute("field-should-validate", true, [e, t, d, i]);
        if (!o) {
            this.emit("core.validator.notvalidated", {element: t, elements: l, field: e, validator: i});
            return Promise.resolve("NotValidated")
        }
        this.emit("core.validator.validating", {element: t, elements: l, field: e, validator: i});
        const n = a().validate({element: t, elements: l, field: e, l10n: this.localization, options: s, value: d});
        const h = "function" === typeof n["then"];
        if (h) {
            return n.then(s => {
                const r = this.normalizeResult(e, i, s);
                this.emit("core.validator.validated", {element: t, elements: l, field: e, result: r, validator: i});
                return r.valid ? "Valid" : "Invalid"
            })
        } else {
            const s = this.normalizeResult(e, i, n);
            this.emit("core.validator.validated", {element: t, elements: l, field: e, result: s, validator: i});
            return Promise.resolve(s.valid ? "Valid" : "Invalid")
        }
    }

    getElementValue(e, t, s) {
        const l = i(this.form, e, t, this.elements[e]);
        return this.filter.execute("field-value", l, [l, e, t, s])
    }

    getElements(e) {
        return this.elements[e]
    }

    getFields() {
        return this.fields
    }

    getFormElement() {
        return this.form
    }

    getLocale() {
        return this.locale
    }

    getPlugin(e) {
        return this.plugins[e]
    }

    updateFieldStatus(e, t, i) {
        const s = this.elements[e];
        const l = s[0].getAttribute("type");
        const r = "radio" === l || "checkbox" === l ? [s[0]] : s;
        r.forEach(s => this.updateElementStatus(e, s, t, i));
        if (!i) {
            switch (t) {
                case"NotValidated":
                    this.emit("core.field.notvalidated", e);
                    this.results.delete(e);
                    break;
                case"Validating":
                    this.emit("core.field.validating", e);
                    this.results.delete(e);
                    break;
                case"Valid":
                    this.emit("core.field.valid", e);
                    this.results.set(e, "Valid");
                    break;
                case"Invalid":
                    this.emit("core.field.invalid", e);
                    this.results.set(e, "Invalid");
                    break
            }
        }
        return this
    }

    updateElementStatus(e, t, i, s) {
        const l = this.elements[e];
        const r = this.fields[e].validators;
        const a = s ? [s] : Object.keys(r);
        switch (i) {
            case"NotValidated":
                a.forEach(i => this.emit("core.validator.notvalidated", {
                    element: t,
                    elements: l,
                    field: e,
                    validator: i
                }));
                this.emit("core.element.notvalidated", {element: t, elements: l, field: e});
                break;
            case"Validating":
                a.forEach(i => this.emit("core.validator.validating", {
                    element: t,
                    elements: l,
                    field: e,
                    validator: i
                }));
                this.emit("core.element.validating", {element: t, elements: l, field: e});
                break;
            case"Valid":
                a.forEach(i => this.emit("core.validator.validated", {
                    element: t,
                    field: e,
                    result: {message: r[i].message, valid: true},
                    validator: i
                }));
                this.emit("core.element.validated", {element: t, elements: l, field: e, valid: true});
                break;
            case"Invalid":
                a.forEach(i => this.emit("core.validator.validated", {
                    element: t,
                    field: e,
                    result: {message: r[i].message, valid: false},
                    validator: i
                }));
                this.emit("core.element.validated", {element: t, elements: l, field: e, valid: false});
                break
        }
        return this
    }

    resetForm(e) {
        Object.keys(this.fields).forEach(t => this.resetField(t, e));
        this.emit("core.form.reset", {reset: e});
        return this
    }

    resetField(e, t) {
        if (t) {
            const t = this.elements[e];
            const i = t[0].getAttribute("type");
            t.forEach(e => {
                if ("radio" === i || "checkbox" === i) {
                    e.removeAttribute("selected");
                    e.removeAttribute("checked");
                    e.checked = false
                } else {
                    e.setAttribute("value", "");
                    if (e instanceof HTMLInputElement || e instanceof HTMLTextAreaElement) {
                        e.value = ""
                    }
                }
            })
        }
        this.updateFieldStatus(e, "NotValidated");
        this.emit("core.field.reset", {field: e, reset: t});
        return this
    }

    revalidateField(e) {
        this.updateFieldStatus(e, "NotValidated");
        return this.validateField(e)
    }

    disableValidator(e, t) {
        return this.toggleValidator(false, e, t)
    }

    enableValidator(e, t) {
        return this.toggleValidator(true, e, t)
    }

    updateValidatorOption(e, t, i, s) {
        if (this.fields[e] && this.fields[e].validators && this.fields[e].validators[t]) {
            this.fields[e].validators[t][i] = s
        }
        return this
    }

    setFieldOptions(e, t) {
        this.fields[e] = t;
        return this
    }

    destroy() {
        Object.keys(this.plugins).forEach(e => this.plugins[e].uninstall());
        this.ee.clear();
        this.filter.clear();
        this.results.clear();
        this.plugins = {};
        return this
    }

    setLocale(e, t) {
        this.locale = e;
        this.localization = t;
        return this
    }

    waterfall(e) {
        return e.reduce((e, t, i, s) => e.then(e => t().then(t => {
            e.push(t);
            return e
        })), Promise.resolve([]))
    }

    queryElements(e) {
        const t = this.fields[e].selector ? "#" === this.fields[e].selector.charAt(0) ? `[id="${this.fields[e].selector.substring(1)}"]` : this.fields[e].selector : `[name="${e}"]`;
        return [].slice.call(this.form.querySelectorAll(t))
    }

    normalizeResult(e, t, i) {
        const s = this.fields[e].validators[t];
        return Object.assign({}, i, {message: i.message || (s ? s.message : "") || (this.localization && this.localization[t] && this.localization[t].default ? this.localization[t].default : "") || `The field ${e} is not valid`})
    }

    toggleValidator(e, t, i) {
        const s = this.fields[t].validators;
        if (i && s && s[i]) {
            this.fields[t].validators[i].enabled = e
        } else if (!i) {
            Object.keys(s).forEach(i => this.fields[t].validators[i].enabled = e)
        }
        return this.updateFieldStatus(t, "NotValidated", i)
    }
}

export default function r(e, t) {
    const i = Object.assign({}, {fields: {}, locale: "en_US", plugins: {}}, t);
    const r = new l(e, i.fields);
    r.setLocale(i.locale, i.localization);
    Object.keys(i.plugins).forEach(e => r.registerPlugin(e, i.plugins[e]));
    Object.keys(s).forEach(e => r.registerValidator(e, s[e]));
    Object.keys(i.fields).forEach(e => r.addField(e, i.fields[e]));
    return r
}
export {l as Core};
