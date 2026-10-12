export function objectsDeeplyEqual(cmp1, cmp2){
    if (cmp1 === cmp2){
        return true;
    }

    if (cmp1 === null || cmp2 === null){
        return false;
    }

    if (typeof cmp1 !== "object" || typeof cmp2 !== "object"){      // typeof: 用來檢查資料型態的運算子(ex: string,number...)
        return false;
    }

    let keys1 = Object.keys(cmp1);     // Object.keys(): 取得物件所有的key
    let keys2 = Object.keys(cmp2);

    if (keys1.length !== keys2.length) {
        return false;
    }

    for (let key of keys1) {
        if (!Object.prototype.hasOwnProperty.call(cmp2, key)) {     // hasOwnProperty: 檢查物件本身是否擁有某個屬性
            return false;                                          // .call(): 指定要在哪個物件上執行這個方法
        }

        if (!objectsDeeplyEqual(cmp1[key], cmp2[key])) {
            return false;
        }
    }

    return true;
}